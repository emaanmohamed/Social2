<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = Users::all();
        return view('user_test', compact('users'));
    }
}
