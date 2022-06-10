<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;


class UsersController extends Controller
{
  public function index()
  {
    $users = User::get();
    return response($users, 200, ["ok"]);
  }
}
