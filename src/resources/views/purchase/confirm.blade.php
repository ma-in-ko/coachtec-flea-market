@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/confirm.css') }}">
@endsection

@section('main')
    <div class="card">
        <div class="card__inner">
            <section class="card__left">
                <div class="purchase-item">
                    <img src="#" alt="商品画像">
                    <div class="purchase-item__group">
                        <p class="purchase__name">
                            商品名
                        </p>
                        <p class="purchase__price">
                            ￥47,000
                        </p>
                    </div>
                </div>

                <form action="#" class="purchase-form" method="post">
                    @csrf
                    <div class="purchase__group">
                        <label for="purchase__payment-method" class="purchase__label">
                        支払い方法
                        </label>
                        <select name="payment-method" id="payment-method" class="purchase__payment-method">
                            <option value="1">コンビニ支払い</option>
                            <option value="2">カード支払い</option>
                        </select>
                    </div>

                    <div class="purchase__group">
                        <div class="shipping-address">
                            <label for="shipping-address" class="purchase__label">
                                配送先
                            </label>
                            <a class="shipping-address__change" href="#">変更する</a>
                        </div>
                        <ul class="purchase__shipping-address">
                            <li class="postcode">
                                <span>〒</span>
                            </li>
                            <li class="address">
                                ここには住所と建物が入ります
                            </li>
                        </ul>
                    </div>
                </form>
            </section>

            <section class="card__right">
                <table class="purchase-summary">
                    <tr class="purchase-summary__price">
                        <th> 商品代金</th>
                        <td>47,000</td>
                    </tr>
                    <tr class="purchase-summary__payment-method">
                        <th>支払い方法</th>
                        <td>コンビニ支払い</td>
                    </tr>
                </table>
                <form action="#" class="purchase-summary__action" method="get">
                    <button class="purchase-summary__action">
                        購入する
                    </button>
                </form>
            </section>
        </div>
    </div>

@endsection