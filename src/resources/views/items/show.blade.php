@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('main')
    <div class="card">
        <div class="card__inner">
            <article class="card__left">
                <img src="#" alt="商品画像">
            </article>
            <article class="card__right">
                <div class="card__content">

                    <!--  商品概要 -->
                    <section class="item-detail__summary">
                        <div class="item-detail__name">
                            商品名
                        </div>

                        <div class="item-detail__brand">
                            <p>ブランド名</p>
                        </div>

                        <div class="item-detail__price">
                            <span>￥</span> <span class="price">47,000</span> (税込み)
                        </div>

                        <div class="item-detail__evaluation">
                            <div class="item-detail__likes">
                                <p class="icon">お気に入りアイコン</p>
                                <p class="item-detail__likes-count">
                                    お気に入り数
                                </p>
                            </div>
                            <div class="item-detail__comment">
                                <p class="icon">吹き出しアイコン</p>
                                <p class="item-detail__comment-count">コメント数</p>
                            </div>
                        </div>

                        <button class="item-detail__purchase">
                            購入手続きへ
                        </button>
                    </section>

                    <!--  商品説明  -->
                    <section class="item-detail__desc">
                        <div class="item-detail__title">
                            商品説明
                        </div>

                        <div class="item-detail__desc-body">
                            カラー：グレー<br><br>
                            新品<br>
                            商品の状態は良好です。傷もありません。<br><br>
                            購入後、即発送いたします。
                        </div>
                    </section>

                    <!-- 商品情報  -->
                    <section class="item-detail__info">
                        <div class="item-detail__title">
                            商品の情報
                        </div>

                        <table class="item__info">
                            <tr>
                                <th class="category">カテゴリー</th>
                                <td>
                                    <span>洋服</span>
                                    <span>メンズ</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="condition">商品の状態</th>
                                <td>良好</td>
                            </tr>
                        </table>
                    </section>

                    <!--  コメント  -->
                    <section class="item-detail__comments comments">
                        <div class="item-detail__title comments__title">
                            コメント
                        </div>
                        <span>（1）</span>

                        <ul class="comments__list">
                            <li class="comments__item">
                                <div class="comments__user">
                                    <img class="comments__avatar" src="#" alt="user-image">
                                    <p class="comments__name">user_name</p>
                                </div>
                                <p class="comment__text">コメント文
                                </p>
                            </li>
                        </ul>

                        <div class="comments__form">
                            <div class="comments__form-title">商品へのコメント</div>
                            <form class="comments__form-text" action="#" method="post">
                                @csrf
                                <textarea name="textarea" cols="30" rows="10">
                                </textarea>
                                <button  class="comments__form-submit" type="submit" >
                                    コメントを送信する
                                </button>
                            </form>
                        </div>
                    </section>

                </div>
            </article>
        </div>
    </div>
@endsection