<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\Profile;


class PurchaseController extends Controller
{
    /*購入*/
    public function create(Item $item)
    {
        return view('purchase.confirm');
    }

    public function store(Request $request, Item $item)
    {
        return redirect('/');
    }

    /*配送先変更*/
    public function edit(Item $item)
    {
        return view ('purchase.address_edit');
    }

    public function update(Request $request, Item $item)
    {
        return redirect ('/purchase/ .$item->id');
    }
}
