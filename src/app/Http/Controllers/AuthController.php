<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*会員登録*/
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        return redirect('/');
    }

    /*ログイン*/
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        return redirect('/');
    }

    /*ログアウト*/
    public function logout()
    {
        return redirect('/');
    }
}
