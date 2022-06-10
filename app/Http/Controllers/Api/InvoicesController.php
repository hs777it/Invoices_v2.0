<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(){
        $invoices = Invoices::get();
        return response($invoices,200,["ok"]);
    }

    public function get($id)
    {
        $invoices = Invoices::where('id',"=", $id)->first();
        return response($invoices,200,["ok"]);
    }
}
