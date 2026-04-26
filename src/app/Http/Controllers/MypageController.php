<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;
        $page = $request->query('page');

        if ($page === 'buy') {
            //購入した商品
            $items = $user->purchases()->with('item')->latest()->get();
        } else {
            //デフォルト（出品）
            $items = $user->items()->with('purchase')->latest()->get();
        }

    return view('mypage.index', compact('user', 'profile', 'items', 'page'));
    }

    /*編集・更新*/
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile ?? new Profile();

        return view('mypage.edit', compact('profile', 'user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        // ユーザー名更新
        $user->update([
            'name' => $request->name
        ]);

        $imagePath = null;

        //画像がある場合
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        // プロフィール保存
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
                'image' => $imagePath,
            ]
        );

        return redirect()->route('mypage');
    }
}