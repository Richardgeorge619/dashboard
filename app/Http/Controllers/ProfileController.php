<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::with('addresses')->findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect('/profile')->with('success', 'User updated successfully.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
