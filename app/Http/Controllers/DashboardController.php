<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        return view('users.index', ['users' => $users]);
    }
}