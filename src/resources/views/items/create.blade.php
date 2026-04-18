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

                    @error('image')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!--  商品の詳細  -->
            <div class="sell-form__group">
                <h3>商品の詳細</h3>
                <label class="sell-form__label">カテゴリー</label>

                <div class="checkbox__block">
                    <input
                        type="checkbox"
                        id="cat1"
                        name="categories[]"
                        value="1"
                        {{ in_array(1, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat1" class="category__button">
                    ファッション
                    </label>
                    <input
                        type="checkbox"
                        id="cat2"
                        name="categories[]"
                        value="2"
                        {{ in_array(2, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat2" class="category__button">
                    家電
                    </label>
                    <input
                        type="checkbox"
                        id="cat3"
                        name="categories[]"
                        value="3" {{ in_array(3, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat3" class="category__button">
                    インテリア
                    </label>
                    <input
                        type="checkbox"
                        id="cat4"
                        name="categories[]"
                        value="4"
                        {{ in_array(4, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat4" class="category__button">
                    レディース
                    </label>
                    <input
                        type="checkbox"
                        id="cat5"
                        name="categories[]"
                        value="5" {{ in_array(5, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat5" class="category__button">
                    メンズ
                    </label>
                    <input
                        type="checkbox"
                        id="cat6"
                        name="categories[]"
                        value="6" {{ in_array(6, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat6" class="category__button">
                    コスメ
                    </label>
                    <input
                        type="checkbox"
                        id="cat7"
                        name="categories[]"
                        value="7" {{ in_array(7, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat7" class="category__button">
                    本
                    </label>
                    <input
                        type="checkbox"
                        id="cat8"
                        name="categories[]"
                        value="8"
                        {{ in_array(8, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat8" class="category__button">
                    ゲーム
                    </label>
                    <input
                        type="checkbox"
                        id="cat9"
                        name="categories[]"
                        value="9"
                        {{ in_array(9, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat9" class="category__button">
                スポーツ
                    </label>
                    <input 
                        type="checkbox"
                        id="cat10"
                        name="categories[]"
                        value="10" {{ in_array(10, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat10" class="category__button">
                キッチン
                    </label>
                    <input
                        type="checkbox"
                        id="cat11" 
                        name="categories[]"
                        value="11"
                        {{ in_array(11, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat11" class="category__button">
                ハンドメイド
                    </label>
                    <input 
                        type="checkbox"
                        id="cat12"
                        name="categories[]" value="12"
                        {{ in_array(12, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat12" class="category__button">
                アクセサリー
                    </label>
                    <input type="checkbox" id="cat13" name="categories[]" value="13" {{ in_array(13, old('categories', [])) ? 'checked' : '' }} class="sell-form__category-input" >
                    <label for="cat13" class="category__button">
                    おもちゃ
                    </label>
                    <input
                        type="checkbox"
                        id="cat14"
                        name="categories[]"
                        value="14" {{ in_array(14, old('categories', [])) ? 'checked' : '' }}
                        class="sell-form__category-input" >
                    <label for="cat14" class="category__button">
                    ベビー・キッズ
                    </label>
                    @error('categories')
                     <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">商品の状態</label>
                    <select name="condition" class="sell-form__select">
                        <option value="" disabled selected>選択してください</option>
                        <option value="1" {{ old('condition') == '1' ? 'selected' : '' }}>良好</option>
                        <option value="2" {{ old('condition') == '2' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                        <option value="3" {{ old('condition') == '3' ? 'selected' : '' }}>やや傷や汚れなし</option>
                        <option value="4" {{ old('condition') == '4' ? 'selected' : '' }}>状態が悪い</option>
                    </select>
                    @error('condition')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
            </div>

            <!-- 商品名と説明 -->
             <h3>商品名と説明</h3>
            <div class="sell-form__group">
                <label class="sell-form__label">商品名</label>
                <input type="text" name="name" class="sell-form__input" value="{{ old('name') }}">
                @error('name')
                 <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">ブランド名</label>
                <input type="text" name="brand" class="sell-form__input" value="{{ old('brand') }}">
                @error('brand')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">商品の説明</label>
                <textarea name="description" class="sell-form__textarea" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">販売価格</label>
                <div class="price-input">
                    <span class="sell-form__price-mark">￥</span>
                    <input type="number" name="price" class="sell-form__input" value="{{ old('price') }}">
                    @error('price')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="sell-form__submit">出品する</button>
        </form>
    </section>

@endsection