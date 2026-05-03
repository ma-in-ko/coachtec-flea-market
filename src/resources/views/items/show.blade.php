@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('main')
    <div class="card">
        <div class="card__inner">
            <section class="card__left">
                @if(Str::startsWith($item->image, 'http'))
                    <img src="{{ $item->image }}" alt="商品画像">
                @else
                    <img src="{{ asset('storage/' .$item->image) }}" alt="商品画像">
                @endif
            </section>
            <section class="card__right">
                <div class="card__content">
                    <x-item-summary :item="$item" />
                    <x-item-description :item="$item" />
                    <x-item-info :item="$item" />
                    <x-item-comments :item="$item" />
                </div>
            </section>
        </div>
    </div>
@endsection