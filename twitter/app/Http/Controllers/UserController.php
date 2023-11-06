<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAll();
        return view('user.index', compact('users'));
    }
}
