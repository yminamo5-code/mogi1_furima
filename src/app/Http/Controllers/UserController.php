<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile_edit(Request $request)
    {    
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    public function profile_update(ProfileRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'image' => $request->image,
            'name' => $request->name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('profile')->with('success', 'プロフィールを更新しました');
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
