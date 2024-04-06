<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class AdminUserController extends Controller
{
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->employmentStatus = $request->input('employmentStatus');
        $user->save();
        
        return redirect()->route('user.show', $user)->with('message', '更新しました。');
    }
}
