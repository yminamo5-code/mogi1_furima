<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Like;
use App\Models\User;
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
        $user = auth()->user();
        $item = Item::findOrFail($id);

        if ($user) {
            $liked = Like::where('user_id', $user->id)
                        ->where('item_id', $item->id)
                        ->exists();
        } else {
            $liked = false;
        }

        $likeCount = Like::where('item_id', $item->id)->count();

        $comments=Comment::where('item_id',$item->id)
                        ->with('user')
                        ->get();

        $commentCount = Comment::where('item_id', $item->id)->count();
        return view('item', compact('item','liked','likeCount','commentCount','comments'));
    }

    public function togglelike($item_id)
    {
        $user=auth()->user();
        if(!$user){
            return redirect('/login');
        }

        $like=Like::where('user_id', $user->id)
                    ->where('item_id', $item_id)
                    ->first();

        if($like){
            $like->delete();
        }else{
            Like::create([
                'user_id'=>$user->id,
                'item_id'=>$item_id,
            ]);
        }
        return redirect()->back();

    }

    public function purchase(Request $request)
    {
        $user=auth()->user();
        $id = $request->input('id');
        $item = Item::findOrFail($id);
        return view('purchase', compact('item', 'user'));
    }

    public function comment(CommentRequest $request)
    {
        $user=auth()->user();
        if(!$user){
            return redirect('/login');
        }

        Comment::create([
            'item_id' => $request->item_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('item.show', [
            'id'=>$request->item_id
        ]);        
    }

    public function list()
    {
        $categories = Category::all();
        return view('list', compact('categories'));
    }
}