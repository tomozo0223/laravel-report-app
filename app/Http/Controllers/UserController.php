<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);

        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize($user);
        dd($user);
        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize($user);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->employmentStatus = $request->input('employmentStatus');
        $user->save();

        return redirect()->route('user.show', $user)->with('message', '更新しました。');
    }
}
