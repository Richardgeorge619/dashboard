<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface UserValidatorInterface {
    public function validateAndUpdate(User $user, Request $request): void;
}