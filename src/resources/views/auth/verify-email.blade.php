@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('main')
    <section class="verify-email__card card">
        <div class="verify-email auth-form">
            <div class="verify-email__message">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
            </div>

            <a href="http://localhost:8025"
                target="blank"
                class="verify-email__button">
                認証はこちらから
            </a>
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <x-button class="verify-email__resend">
                    認証メールを再送する
                </x-button>
        </div>
    </section>
@endsection
