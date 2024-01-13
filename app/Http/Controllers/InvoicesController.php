<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\invoices;
use App\sections;
use App\User;
use App\invoices_details;
use App\invoice_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\MyEventClass;
use App\Notifications\AddInvoice;
use App\Notifications\Add_invoice_new;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }

    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoice', compact('sections'));
    }

    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('image')) {

            $this->validate(
                $request,
                ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'],
                ['image.mimes' => 'تم حفظ الفاتورة ولم يتم حفظ المرفق']
            );

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->invoice_id = $invoice_id;
            $attachments->created_by = Auth::user()->name;
            $attachments->save();

            // save image to public
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('attachments/' . $invoice_number), $imageName);
        }

        // $user = User::first();
        // $user->notify(new AddInvoice($invoice_id));
        // Notification::send($user, new AddInvoice($invoice_id));

        $user = User::get();
        $invoices = invoices::latest()->first();
        Notification::send($user, new Add_invoice_new($invoices));
        event(new MyEventClass('hello world'));

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }

    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = invoices::where('id', $id)->first();
        $sections = sections::all();
        return view(
            'invoices.edit_invoice',
            compact('sections', 'invoice')
        );
    }

    public function update(Request $request)
    {
        $invoice = invoices::findOrFail($request->invoice_id);
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = invoices::where('id', $id)->first();
        $details = invoice_attachments::where('invoice_id', $id)->first();

        $btn_action = $request->btn_action;
        if ($btn_action == '0') {

            if (!empty($details->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
            }

            $invoice->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        } else {
            $invoice->delete();
            session()->flash('archive_invoice');
            return redirect('/archive');
        }
    }

    public function getProducts($id)
    {
        $products = DB::table("products")
            ->where("section_id", $id)
            ->pluck("Product_name", "id");
        return json_encode($products);
    }


    public function status_update($id, Request $request)
    {
        $invoice = invoices::findOrFail($id);

        if ($request->status === 'مدفوعة') {

            $invoice->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);

            invoices_Details::create([
                'id_invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoice->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);
            invoices_Details::create([
                'id_invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 3,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }


    public function invoices_paid()
    {
        $invoices = Invoices::where('value_status', 1)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }

    public function invoices_unpaid()
    {
        $invoices = Invoices::where('value_status', 2)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }

    public function invoices_partial()
    {
        $invoices = Invoices::where('value_status', 3)->get();
        return view('invoices.invoices_partial', compact('invoices'));
    }

    public function print_invoice($id)
    {
        $invoice = invoices::where('id', $id)->first();
        return view('invoices.print_invoice', compact('invoice'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }


    public function MarkAsRead_all(Request $request)
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }

    public function unreadNotifications_count()
    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {

            return $notification->data['title'];
        }
    }
}
