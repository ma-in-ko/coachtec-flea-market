@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
@endsection

@section('main')
    <div class="main__inner">

        <div class="user-profile">
            <div class="user-profile__image-wrapper">
                <img src="{{ $profile && $profile->image ? asset('storage/' . $profile->image) : asset('images/default.png') }}"
                class="user-profile__image" alt="ユーザー画像">
            </div>
            <div class="user-profile__info">
                <p class="user-profile__name">{{ $user->name }}</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="user-profile__edit">
            プロフィールを編集
            </a>
        </div>
    </div>

    <div class="top__menu">
        <a href="{{ route('mypage', ['page' => 'sell']) }}"
            class="menu__sell-list {{ $page !== 'buy' ? 'active' : '' }}">
            出品した商品
        </a>
        <a href="{{ route('mypage', ['page' => 'buy']) }}"
            class="menu__buy-list {{ $page === 'buy' ? 'active' : '' }}">
            購入した商品
        </a>
    </div>

    <div class="exhibition">
        <ul class="item__list">
            {{-- BUY --}}
            @if($page === 'buy')
                @forelse($items as $purchase)
                    <x-item-card :item="$purchase->item" />
                @empty
                    <p>購入した商品はありません</p>
                @endforelse
            @endif

            {{-- SELL --}}
            @if($page !== 'buy')
                @forelse($items as $item)
                    <x-item-card :item="$item" />
                @empty
                    <p>出品した商品はありません</p>
                @endforelse
            @endif

        </ul>
    </div>

@endsection