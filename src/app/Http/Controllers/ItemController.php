<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('item', compact('item'));
    }

    public function purchase(Request $request)
    {
        $id = $request->input('id');
        $item = Item::findOrFail($id);
        return view('purchase', compact('item'));
    }

    public function list()
    {
        $categories = Category::all();
        return view('list', compact('categories'));
    }
}