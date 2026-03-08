<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;

class CommentController extends Controller
{
    public function store(Request $request, Item $item)
    {
        return redirect('/item/' .$item->id);
    }
}
