@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection


@section('main')

    <section class="card">
        <form action="#" class="login-form auth-form" method="post">
        @csrf

            <h2 class="login-form__title">ログイン</h2>

            <div class="login-form__group">
                <label class="login-form__label">メールアドレス</label>
                <input type="email" name="email" class="login-form__input">
            </div>
            <div class="login-form__group">
                <label class="login-form__label">パスワード</label>
                <input type="password" name="password" class="login-form__input">
            </div>
            <button class="login-form__submit">ログインする</button>
            <a href="#" class="member-register">会員登録はこちら</a>
        </form>
    </section>

@endsection