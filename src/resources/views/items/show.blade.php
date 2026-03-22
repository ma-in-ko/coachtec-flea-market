@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('main')
    <div class="card">
        <div class="card__inner">
            <section class="card__left">
                <img src="{{ $item->image }}" alt="商品画像">
            </section>
            <section class="card__right">
                <div class="card__content">

                    <!--  商品概要 -->
                    <article class="item-detail__summary">
                        <div class="item-detail__name">
                            {{ $item->name }}
                        </div>

                        <div class="item-detail__brand">
                            <p>{{ $item->brand }}</p>
                        </div>

                        <div class="item-detail__price">
                            <span>￥</span> <span class="price">{{ number_format($item->price) }}</span> (税込)
                        </div>

                        <div class="item-detail__evaluation">
                            <div class="item-detail__likes">
                                <img class="icon" src="{{ asset('images/heart-default.png') }}" alt="いいねアイコン">
                                <p class="item-detail__likes-count">
                                    {{ $item->likes_count }}
                                </p>
                            </div>
                            <div class="item-detail__comment">
                                <img class="icon" src="{{ asset('images/comment-icon.png') }}" alt="コメントアイコン">
                                <p class="item-detail__comment-count">
                                    {{ $item->comments_count }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('purchase.create', $item->id) }}">
                            <x-button class="item-detail__purchase" type="button">
                            購入手続きへ
                            </x-button>
                        </a>
                    </article>

                    <!--  商品説明  -->
                    <article class="item-detail__desc">
                        <div class="item-detail__title">
                            商品説明
                        </div>

                        <div class="item-detail__desc-body">
                            {{ $item->description }}
                        </div>
                    </article>

                    <!-- 商品情報  -->
                    <article class="item-detail__info">
                        <div class="item-detail__title">
                            商品の情報
                        </div>

                        <table class="item__info">
                            <tr>
                                <th class="category">カテゴリー</th>
                                <td>
                                    @foreach($item->categories as $category)
                                        <span class="badge">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th class="condition">商品の状態</th>
                                <td>{{ $item->condition }}</td>
                            </tr>
                        </table>
                    </article>

                    <!--  コメント  -->
                    <article class="item-detail__comments comments">
                        <div class="item-detail__title comments__title">
                            コメント
                        </div>
                        <span>({{ $item->comments_count }})</span>

                        <ul class="comments__list">
                            @foreach($item->comments as $comment)
                            <li class="comments__item">
                                <div class="comments__user">
                                    <img class="comments__avatar" src="#" alt="user-image">
                                    <p class="comments__name">user_name</p>
                                </div>
                                <p class="comment__text">{{ $comment->comment }}</p>
                            </li>
                        @endforeach
                        </ul>

                        <div class="comments__form">
                            <div class="comments__form-title">商品へのコメント</div>
                            <form class="comments__form-text" action="#" method="post">
                                @csrf
                                <textarea name="comment" rows="5"></textarea>
                                <x-button  class="comments__form-submit" type="submit" >
                                    コメントを送信する
                                </x-button>
                            </form>
                        </div>
                    </article>

                </div>
            </section>
        </div>
    </div>
@endsection