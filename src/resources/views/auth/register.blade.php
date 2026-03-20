@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('main')

<section class="card">
        <form action="#" class="register-form auth-form" method="post">
        @csrf

            <h2 class="register-form__title">会員登録
            </h2>

            <div class="login-form__group">
                <label class="register-form__label">ユーザー名</label>
                <input type="text" name="name" class="register-form__input">
            </div>
            <div class="register-form__group">
                <label class="register-form__label">メールアドレス</label>
                <input type="email" name="email" class="register-form__input">
            </div>
            <div class="register-form__group">
                <label class="register-form__label">パスワード</label>
                <input type="password" name="password" class="register-form__input">
            </div>
            <div class="register-form__group">
                <label class="register-form__label">確認用パスワード</label>
                <input type="password" name="password" class="register-form__input">
            </div>
            <button class="login-form__submit">登録する</button>
            <a href="#" class="member-login">ログインはこちら</a>
        </form>
    </section>

@endsection