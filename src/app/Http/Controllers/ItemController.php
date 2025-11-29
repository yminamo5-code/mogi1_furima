<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'recommend');

        if($tab === 'recommend'){
            $items = Item::where('user_id', '!=', Auth::id())->get();
        }else{
            $items = collect();
        }
        return view('index', compact('tab', 'items'));
    }

    public function register(UserRequest $request)
    {
        Item::create($request->validate());
        return redirect()->route('register');
    }
}