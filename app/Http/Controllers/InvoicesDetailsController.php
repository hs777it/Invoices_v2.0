<?php

namespace App\Http\Controllers;

use App\invoices_details;
use App\invoices;
use App\invoice_attachments;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{

    public function edit($id)
    {
        $invoice = invoices::where('id', $id)->first();
        $details  = invoices_Details::where('id_invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();

        return view(
            'invoices.details_invoice',
            compact('invoice', 'details', 'attachments')
        );
    }

    public function open_file($invoice_number, $file_name)
    {
        $file = Storage::disk('public_uploads')
            ->getDriver()->getAdapter()
            ->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($file);
    }

    public function get_file($invoice_number, $file_name)
    {
        $contents = Storage::disk('public_uploads')
            ->getDriver()->getAdapter()
            ->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }

    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function index()
    {
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show(invoices_details $invoices_details)
    {
    }
}
