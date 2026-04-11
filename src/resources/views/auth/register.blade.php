@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('main')

<section class="card">
        <form action="{{ route('register') }}" class="register-form auth-form" method="post" novalidate>
        @csrf

            <h2 class="register-form__title">会員登録
            </h2>

            <div class="login-form__group">
                <label class="register-form__label">ユーザー名</label>
                <input type="text" name="name" class="register-form__input" value="{{ old('name') }}">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group">
                <label class="register-form__label">メールアドレス</label>
                <input type="email" name="email" class="register-form__input" value="{{ old('email') }}">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group">
                <label class="register-form__label">パスワード</label>
                <input type="password" name="password" class="register-form__input">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="register-form__group">
                <label class="register-form__label">確認用パスワード</label>
                <input type="password" name="password_confirmation" class="register-form__input">
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="login-form__submit">登録する</button>
            <a href="{{ route('login') }}" class="member-login">ログインはこちら</a>
        </form>
    </section>

@endsection