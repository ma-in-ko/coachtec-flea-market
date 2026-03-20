@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('main')
<div class="main__inner">

    <div class="top__menu">
        <a class="menu__recommend" href="#">おすすめ</a>
        <a class="menu__mylist" href="#">マイリスト</a>
    </div>

    <div class="exhibition">
        <ul class="item__list">

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                </div>
                <p class="item__name">商品名</p>
            </li>

            <li class="item">
                <div class="item__image-wrapper">
                    <img class="item__image" src="" alt="商品画像">
                </div>
                <p class="item__name">商品名</p>
            </li>

        </ul>
    </div>

</div>
@endsection