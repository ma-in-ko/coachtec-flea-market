<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\ExhibitionRequest;


class ItemController extends Controller
{
    /*商品一覧トップ画面*/
    public function index()
    {
        $items = Item::latest()->get();

        return view('items.index',compact('items'));
    }

    /*詳細画面*/
    public function show(Item $item)
    {
        $item->load(['categories', 'comments.user']);
        $item->loadCount(['likes','comments']);

        return view('items.show', compact('item'));
    }

    /*出品画面*/
    public function create()
    {
        return view('items.create');
    }

    /*出品処理*/
    public function store(ExhibitionRequest $request)
    {
        //画像保存
        $path = $request->file('image')->store('items','public');

        //商品作成
        $item = Item::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'condition' => $request->condition,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path,
            'user_id' => auth()->id(),
        ]);

        //カテゴリー紐づけ
        $item->categories()->sync($request->categories);

        return redirect('/');
    }
}
