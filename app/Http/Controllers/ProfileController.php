<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserValidatorInterface;

class ProfileController extends Controller
{
    private $userValidator;

    public function __construct(UserValidatorInterface $userValidator) {
        $this->userValidator = $userValidator;
    }

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
            $user = User::findOrFail($id);
            $this->userValidator->validateAndUpdate($user, $request);

            return redirect('/profile')->with('success', 'User updated successfully.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
