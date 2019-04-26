<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
