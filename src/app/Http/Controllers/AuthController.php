<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = app(CreatesNewUsers::class)->create($request->validated());
        Auth::login($user);
        return view('profile_edit', ['user' => $user]);
    }   
}
