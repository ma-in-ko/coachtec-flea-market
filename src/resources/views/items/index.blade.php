@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('main')


<div class="main__inner">

<div class="top__menu">
    <a href="{{ route('items.index', request()->query()) }}"
    class="{{ request()->is('/') ? 'active' : '' }}">
        おすすめ
    </a>

    <a href="{{ route('items.mylist', request()->query()) }}"
    class="{{ request()->is('mylist') ? 'active' : '' }}">
        マイリスト
    </a>
</div>

    <div class="exhibition">
        @if($items->isEmpty())
            <p>商品がありません</p>
        @else
            <ul class="item__list">
                @foreach($items as $item)
                    <x-item-card :item="$item" />
                @endforeach
            </ul>
            {{ $items->links() }}
        @endif

    </div>
</div>
@endsection