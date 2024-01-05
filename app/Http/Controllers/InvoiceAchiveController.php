<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;

class InvoiceAchiveController extends Controller
{

    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('Invoices.archive_invoices', compact('invoices'));
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy(Request $request)
    {
        $invoices = invoices::withTrashed()->where('id', $request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/archive');
    }

    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
}
