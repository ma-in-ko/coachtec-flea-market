<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Reuqests\RegisterRequest;
use App\Actions\Fortify\CreateNewUser;

class AuthController extends Controller
{
    /*会員登録*/
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $createNewUser->crate($request->validated());

        return redirect('/');
    }

    /*ログイン*/
    /*public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');

            return back()->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ]);
        }
    }

    /*ログアウト*/
    public function logout()
    {
        return redirect('/');
    }
}
