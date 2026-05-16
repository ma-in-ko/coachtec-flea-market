@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/create.css') }}">
@endsection

@section('main')
    <section class="card">
        <form action="{{ route('sell.store') }}" class="sell-form" method="post" enctype="multipart/form-data">
        @csrf

            <h2 class="sell-form__title">商品の出品</h2>

            <!--  商品画像  -->
            <div class="sell-form__group">
                <label class="sell-form__label">商品画像</label>
                <div class="image-upload">
                    <label class="image-upload__button">画像を選択する
                        <input type="file" name="image" class="sell-form__image">
                    </label>

                    <x-error field="image" />

                </div>
            </div>

            <!--  商品の詳細  -->
            <div class="sell-form__group">
                <h3>商品の詳細</h3>
                <label class="sell-form__label">カテゴリー</label>

                <div class="checkbox__block">
                    @php
                    $categories = [
                        1 => 'ファッション',
                        2 => '家電',
                        3 => 'インテリア',
                        4 => 'レディース',
                        5 => 'メンズ',
                        6 => 'コスメ',
                        7 => '本',
                        8 => 'ゲーム',
                        9 => 'スポーツ',
                        10 => 'キッチン',
                        11=> 'ハンドメイド',
                        12 => 'アクセサリー',
                        13 => 'おもちゃ',
                        14 => 'ベビー・キッズ',
                    ];
                    @endphp

                    @foreach($categories as $id => $category)
                        <input
                        type="checkbox"
                        id="cat{{ $id }}"
                        name="categories[]"
                        value="{{ $id }}"
                        {{ in_array($id, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >

                        <label for="cat{{ $id }}" class="category__button">
                            {{ $category }}
                        </label>
                    @endforeach


                    <x-error field="categories" />

                </div>
            </div>

            @php
                $conditions =[
                1 => '良好',
                2 => '目立った傷や汚れなし',
                3 => 'やや傷や汚れあり',
                4 => '状態が悪い',
                ];
            @endphp

            <div class="sell-form__group">
                <label class="sell-form__label">商品の状態</label>
                    <select name="condition" class="sell-form__select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($conditions as $value => $condition)
                            <option value="{{ $value }}" {{ old('condition') == $value ? 'selected' : '' }}>{{ $condition }}</option>
                        @endforeach
                    </select>

                    <x-error field="condition" />
            </div>

            <!-- 商品名と説明 -->
            <h3>商品名と説明</h3>
            <div class="sell-form__group">
                <label class="sell-form__label">商品名</label>
                <input type="text" name="name" class="sell-form__input" value="{{ old('name') }}">

                <x-error field="name" />

            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">ブランド名</label>
                <input type="text" name="brand" class="sell-form__input" value="{{ old('brand') }}">

                <x-error field="brand" />

            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">商品の説明</label>
                <textarea name="description" class="sell-form__textarea" cols="30" rows="10">{{ old('description') }}</textarea>

                <x-error field="description" />

            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">販売価格</label>
                <div class="price-input">
                    <span class="sell-form__price-mark">￥</span>
                    <input type="number" name="price" class="sell-form__input" value="{{ old('price') }}">

                    <x-error field="price" />

                </div>
            </div>
            <x-button type="submit" class="btn sell-form__submit">出品する</x-button>
        </form>
    </section>

@endsection