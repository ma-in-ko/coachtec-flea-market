<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\Like;
use App\Models\Comment;


class ItemController extends Controller
{
    /*商品一覧トップ画面*/
    public function index()
    {
        return view('items.index');
    }

    /*詳細画面*/
    public function show(Item $item)
    {
        return view('items.show');
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
