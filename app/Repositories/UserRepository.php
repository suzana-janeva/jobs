<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function saveUser(Request $request) : User
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
        ]);

        return $user;
    }

    public function updateUser(Request $request, User $user) : User
    {
        $user->fill($request->except('posted_rate'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        return $user;
    }
}