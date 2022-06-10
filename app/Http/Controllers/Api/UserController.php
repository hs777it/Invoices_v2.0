<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return response($users,200,["ok"]);
    }

    public function get($id)
    {
        $user = User::where('id',"=", $id)->first();
        return response($user,200,["ok"]);

        // $user = User::find($id)->with('acceptedFriends')->firstOrFail();
        // $user = User::find($id)->firstOrFail();
    }
}
