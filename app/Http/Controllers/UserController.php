<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserValidatorInterface;


class UserController extends Controller
{
    private $userValidator;

    public function __construct(UserValidatorInterface $userValidator) {
        $this->userValidator = $userValidator;
    }

    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        $users = User::getUserByStatus(false);
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->is_admin = $request->is_admin ? 1 : 0;
            $user->save();

            return redirect('/users')->with('success', 'User created successfully.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::with('addresses')->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
            $this->userValidator->validateAndUpdate($user, $request);

            return redirect('/users')->with('success', 'User updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully.');
    }
}
