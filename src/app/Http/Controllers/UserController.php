<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile_update(ProfileRequest $request)
    {
        $user = auth()->user();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }        

        $user->update([
            'image' => $path,
            'name' => $request->name,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect('/');
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
