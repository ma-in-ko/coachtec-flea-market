@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/address_edit.css') }}">
@endsection

@section('main')
        <section class="card">
        <form action="#" class="address-edit" method="post">
        @csrf

            <h2 class="address-edit__title">
                住所の変更
            </h2>

             <div class="address-edit__group">
                <label for="postcode" class="address-edit__label">郵便番号</label>
                <input type="text" name="postcode" class="address-edit__input">
            </div>
            <div class="address-edit__group">
                <label for="address" class="address-edit__label">住所</label>
                <input type="text" name="address" class="address-edit__input">
            </div>
            <div class="address-edit__group">
                <label type="buildint" class="address-edit__label">建物名</label>
                <input type="text" name="building" class="address-edit__input">
            </div>
            <button type="submit" class="address-edit__select">更新する</button>
        </form>
    </section>
@endsection