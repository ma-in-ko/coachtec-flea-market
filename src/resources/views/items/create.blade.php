@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/create.css') }}">
@endsection

@section('main')
    <section class="card">
        <form action="#" class="sell-form" method="post" enctype="multipart/form-data">
        @csrf

            <h2 class="sell-form__title">商品の出品</h2>

            <!--  商品画像  -->
            <div class="sell-form__group">
                <label class="sell-form__label">商品画像</label>
                <div class="image-upload">
                    <label class="image-upload__button">画像を選択する
                        <input type="file" name="image" class="sell-form__image">
                    </label>
                </div>
            </div>

            <!--  商品の詳細  -->
            <div class="sell-form__group">
                <h3>商品の詳細</h3>
                <label class="sell-form__label">カテゴリー</label>

                <div class="checkbox__block">
                    <input type="checkbox" id="cat1" name="categories[]" value="1" class="sell-form__category-input" >
                    <label for="cat1" class="category__button">
                    ファッション
                    </label>
                    <input type="checkbox" id="cat2" name="categories[]" value="2" class="sell-form__category-input" >
                    <label for="cat2" class="category__button">
                    家電
                    </label>
                    <input type="checkbox" id="cat3" name="categories[]" value="3" class="sell-form__category-input" >
                    <label for="cat3" class="category__button">
                    インテリア
                    </label>
                    <input type="checkbox" id="cat4" name="categories[]" value="4" class="sell-form__category-input" >
                    <label for="cat4" class="category__button">
                    レディース
                    </label>
                    <input type="checkbox" id="cat5" name="categories[]" value="5" class="sell-form__category-input" >
                    <label for="cat5" class="category__button">
                    メンズ
                    </label>
                    <input type="checkbox" id="cat6" name="categories[]" value="6" class="sell-form__category-input" >
                    <label for="cat6" class="category__button">
                    コスメ
                    </label>
                    <input type="checkbox" id="cat7" name="categories[]" value="7" class="sell-form__category-input" >
                    <label for="cat7" class="category__button">
                    本
                    </label>
                    <input type="checkbox" id="cat8" name="categories[]" value="8" class="sell-form__category-input" >
                    <label for="cat8" class="category__button">
                    ゲーム
                    </label>
                    <input type="checkbox" id="cat9" name="categories[]" value="9" class="sell-form__category-input" >
                    <label for="cat9" class="category__button">
                スポーツ
                    </label>
                    <input type="checkbox" id="cat10" name="categories[]" value="10"  class="sell-form__category-input" >
                    <label for="cat10" class="category__button">
                キッチン
                    </label>
                    <input type="checkbox" id="cat11" class="sell-form__category-input" >
                    <label for="cat11" class="category__button">
                ハンドメイド
                    </label>
                    <input type="checkbox" id="cat12" name="categories[]" value="12" class="sell-form__category-input" >
                    <label for="cat12" class="category__button">
                アクセサリー
                    </label>
                    <input type="checkbox" id="cat13" name="categories[]" value="13" class="sell-form__category-input" >
                    <label for="cat13" class="category__button">
                    おもちゃ
                    </label>
                    <input type="checkbox" id="cat14" name="categories[]" value="14" class="sell-form__category-input" >
                    <label for="cat14" class="category__button">
                    ベビー・キッズ
                    </label>
                </div>
            </div>

            <div class="sell-form__group">
                <label class="sell-form__label">商品の状態</label>
                    <select name="condition" class="sell-form__select">
                        <option value="" disabled selected>選択してください</option>
                        <option value="1">良好</option>
                        <option value="2">目立った傷や汚れなし</option>
                        <option value="3">やや傷や汚れなし</option>
                        <option value="4">状態が悪い</option>
                    </select>
            </div>

            <!-- 商品名と説明 -->
             <h3>商品名と説明</h3>
            <div class="sell-form__group">
                <label class="sell-form__label">商品名</label>
                <input type="text" name="name" class="sell-form__input">
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label">ブランド名</label>
                <input type="text" name="brand" class="sell-form__input">
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label">商品の説明</label>
                <textarea name="description" class="sell-form__textarea" cols="30" rows="10"></textarea>
            </div>
            <div class="sell-form__group">
                <label class="sell-form__label">販売価格</label>
                <div class="price-input">
                    <span class="sell-form__price-mark">￥</span>
                    <input type="number" name="price" class="sell-form__input">
                </div>
            </div>
            <button class="sell-form__submit">出品する</button>
        </form>
    </section>

@endsection