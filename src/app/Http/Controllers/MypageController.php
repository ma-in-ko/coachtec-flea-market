<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    /*編集・更新*/
    public function edit()
    {
        $profile = auth()->user()->profile;

        return view('mypage.edit', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        // ユーザー名更新
        $user->update([
            'name' => $request->name
        ]);

        // プロフィール保存
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

        return redirect('/');
    }

}
