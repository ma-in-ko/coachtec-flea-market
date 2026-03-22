@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('main')
<div class="main__inner">

    <div class="top__menu">
        <a class="menu__recommend active" href="#">おすすめ</a>
        <a class="menu__mylist active" href="#">マイリスト</a>
    </div>

    <div class="exhibition">

        <ul class="item__list">
        @foreach($items as $item)
            <x-item-card :item="$item" />
        @endforeach
        </ul>
    </div>

</div>
@endsection