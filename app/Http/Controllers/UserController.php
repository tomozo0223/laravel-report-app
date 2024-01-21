<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);
        $enrollmentNumber = 1;

        return view('user.index', compact('users', 'enrollmentNumber'));
    }
}
