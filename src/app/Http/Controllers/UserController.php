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
        $path = $user->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->hashName();
            $file->storeAs('images',$filename,'public');
            $path = $filename;
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

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $tab = $request->input('page', 'sell');
        $keyword = $request->keyword;

        if($tab === 'sell'){
            $items = Item::where('user_id', Auth::id())
                        ->when($keyword, function($q, $keyword){
                            $q->where('itemname', 'like', '%'.$keyword.'%');
                        })
                    ->get();
        }else{
            $items = $user->purchases()->with('item')
                            ->when($keyword, function($q, $keyword){
                                $q->where('itemname', 'like', '%'.$keyword.'%');
                            })
                            ->get()->pluck('item');
        }
        return view('mypage', compact('user', 'tab', 'items'));
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        return view('profile_edit', compact('user'));
    }

}
