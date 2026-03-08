<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Item;

class LikeController extends Controller
{
    public function store(Item $item)
    {
        return redirect('/item/' .$item->id);
    }

    public function destroy(Item $item)
    {
        return redirect('/item/' .$item->id);
    }
}
