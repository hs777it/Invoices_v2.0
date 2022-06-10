<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\invoices;


class InvoicesController extends Controller
{
  public function index()
  {
    $users = invoices::get();
    return response($users, 200, ["ok"]);
  }
}
