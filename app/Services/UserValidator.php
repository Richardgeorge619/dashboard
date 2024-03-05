<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserValidator implements UserValidatorInterface {
    public function validateAndUpdate(User $user, Request $request): void {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }
}