@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection


@section('main')


    <section class="card">
        <form action="{{ route('login') }}" class="login-form auth-form" method="post" novalidate>
        @csrf

            <h2 class="login-form__title">ログイン</h2>

            <div class="login-form__group">
                <label class="login-form__label">メールアドレス</label>
                <input type="email" name="email" class="login-form__input" value="{{ old('email') }}">

                <x-error field="email" />

            </div>

            <div class="login-form__group">
                <label class="login-form__label">パスワード</label>
                <input type="password" name="password" class="login-form__input">

                <x-error field="password" />
            </div>

            <x-button class="btn login-form__submit">ログインする</x-button>
            <a href="{{ route('register') }}" class="member-register">会員登録はこちら</a>
        </form>
    </section>

@endsection