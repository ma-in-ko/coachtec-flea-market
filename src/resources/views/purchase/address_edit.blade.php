@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/address_edit.css') }}">
@endsection

@section('main')
    <section class="card">
        <form action="{{ route('purchase.address.update', $item->id) }}" class="address-edit" method="POST">
        @csrf
        @method('PUT')

            <h2 class="address-edit__title">
                住所の変更
            </h2>

            <div class="address-edit__group">
                <label for="postcode" class="address-edit__label">郵便番号</label>
                <input type="text" name="postal_code" class="address-edit__input">
                @error('postal_code')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                </div>
            <div class="address-edit__group">
                <label for="address" class="address-edit__label">住所</label>
                <input type="text" name="address" class="address-edit__input">
                @error('address')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="address-edit__group">
                <label type="buildint" class="address-edit__label">建物名</label>
                <input type="text" name="building" class="address-edit__input">
            </div>
            <button type="submit" class="address-edit__select">更新する</button>
        </form>

        <div class="address-edit">
            <form action="{{ route('purchase.address.reset', $item->id) }}"  method="post">
                @csrf
                <button type="submit" class="address-reset__select">デフォルトに戻す</button>
            </form>
        </div>
        
    </section>

@endsection