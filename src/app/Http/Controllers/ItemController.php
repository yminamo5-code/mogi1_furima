<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'recommend');
        $keyword = $request->keyword;

        if($tab === 'recommend'){
            $items = Item::with('purchase')
                    ->where('user_id', '!=', Auth::id())
                    ->when($keyword, function($q, $keyword){
                        $q->where('itemname', 'like', '%'.$keyword.'%');
                    })
                    ->get();
        }else{
            $items = Like::where('user_id', Auth::id())
                ->whereHas('item', function ($q) use ($keyword) {
                    $q->when($keyword, function ($q2, $keyword) {
                        $q2->where('itemname', 'like', '%' . $keyword . '%');
                    });
                })
                ->with('item.purchase')
                ->get()
                ->pluck('item');
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

    public function sell()
    {
        $categories = Category::all();
        return view('sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $user=auth()->user();
        $path=$user->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->hashName();
            $file -> storeAs('images',$filename,'public');
            $path = $filename;
        }   

        $item=Item::create([
            'user_id'=>auth()->id(),
            'itemname'=>$request->itemname,
            'brand'=>$request->brand ?? null,
            'image'=>$path,
            'price'=>$request->price,
            'description'=>$request->description,
            'condition'=>$request->condition
        ]);

        $item->categories()->attach($request->categories);

        return redirect()->route('index');
    }

    public function address_edit($id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($id);
        return view('address', compact('user','item'));
    }

    public function address_update(AddressRequest $request, $id)
    {
        $user = auth()->user();
        $user->update([
            'postcode' => $request->postcode,
            'address'  => $request->address,
            'building' => $request->building,
        ]);        
        return redirect()->route('return.purchase',['id' => $id]);
    }

    public function return_purchase($id)
    {
        $user = auth()->user();
        $item = Item::findOrFail($id);   
        return view('purchase',compact('item','user'));
    }
}