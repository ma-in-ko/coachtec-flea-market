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
    public function index(Request $request)
    {
        $query = Item::query();

        //自分の商品除外
        if(auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        //検索
        if($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $items = $query
            ->with('purchase')
            ->latest()
            ->paginate(12)
            ->appends($request->query());

        $keyword = $request->keyword;

        return view('items.index',compact('items'));
    }

    /*マイリスト*/
    public function mylist(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $query = Item::whereHas('likes', function ($q) {
            $q->where('user_id', auth()->id());
        });

        //検索
        if($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $items = $query
            ->with('purchase')
            ->latest()
            ->paginate(12)
            ->appends($request->query());

        return view('items.index', compact('items'));
    }


    /*詳細画面*/
    public function show(Item $item)
    {
        $item->load([
            'categories',
            'comments.user.profile',
            'purchase',
            ]);

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
