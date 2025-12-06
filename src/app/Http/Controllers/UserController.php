<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('profile_edit');
    }

    public function profile_edit()
    {
    $user = Auth::user();
    return view('profile_edit', compact('user'));
    }

    

    public function profile(Request $request)
    {
        $user = Auth::user();
        $tab = $request->input('tab', 'page=sell');

        if($tab === 'page=sell'){
            $items = Item::where('user_id', Auth::id())->get();
        }else{
            $items = $user()->purchases()->with('item')->get()->pluck('item');
        }
        return view('profile', compact('user', 'tab', 'items'));
    }

}
