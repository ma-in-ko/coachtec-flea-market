@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
@endsection

@section('main')
    <div class="main__inner">

    <div class="user-profile">
        <img src="#" class="user-profile__image" alt="ユーザー画像">
        <div class="user-profile__info">
            <p class="user-profile__name">ユーザー名</p>
        </div>
        <button class="user-profile__edit">プロフィールを編集</button>
    </div>

    <div class="top__menu">
        <a class="menu__sell-list" href="#">出品した商品</a>
        <a class="menu__buy-list" href="#">購入した商品</a>
    </div>

    <div class="exhibition">
        <ul class="item__list">

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                    <span class="item__sold">SOLD</span>
                </div>
                <p class="item__name">商品名</p>
            </li>

        </ul>
    </div>

</div>

@endsection