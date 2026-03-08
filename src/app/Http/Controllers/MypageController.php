<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class MypageController extends Controller
{
    public function show()
    {
        return view('mypage.show');
    }

    /*編集・更新*/
    public function edit()
    {
        return view('mypage.edit');
    }

    public function update(Request $request)
    {
        return redirect('/mypage');
    }

}
