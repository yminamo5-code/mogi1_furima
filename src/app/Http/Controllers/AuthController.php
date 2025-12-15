<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Item;
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

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ]);
        }

        return redirect('/?tab=mylist');
    }
}
