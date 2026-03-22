<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;


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
    public function store(Request $request)
    {
        return redirect('/');
    }
}
