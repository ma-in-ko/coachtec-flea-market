@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/confirm.css') }}">
@endsection

@section('main')
    
        <div class="card__inner">
            <section class="card__left">
                <div class="purchase-item">
                    <img src="{{ $item->image }}" alt="商品画像">
                    <div class="purchase-item__group">
                        <p class="purchase__name">
                            {{ $item->name}}
                        </p>
                        <p class="purchase__price">
                            ￥{{ number_format($item->price) }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('purchase.payment', $item->id) }}" class="purchase-form" method="post">
                    @csrf
                    <div class="purchase__group">
                        <label for="purchase__payment-method" class="purchase__label">
                            支払い方法
                        </label>
                        <select name="payment_method" onchange="this.form.submit()" class="purchase__payment-method">
                            <option value="1" {{ session('payment_method') == 1 ? 'selected' : '' }}>
                                コンビニ支払い</option>
                            <option value="2" {{ session('payment_method') == 2 ? 'selected' : '' }}>カード支払い</option>
                        </select>
                    </div>

                    <div class="purchase__group">
                        <div class="shipping-address">
                            <label for="shipping-address" class="purchase__label">
                                配送先
                            </label>
                            <a class="shipping-address__change" href="{{ route('purchase.address.edit', $item->id) }}">変更する</a>
                        </div>
                        <ul class="purchase__shipping-address">
                            <li class="postcode">
                                <span>{{ session('postal_code') ??'〒000-0000' }}
                                </span>
                            </li>
                            <li class="address">
                                {{ session('address')}}
                                {{ session('building') }}
                            </li>
                        </ul>
                    </div>
                </form>
            </section>

            <section class="card__right">
                <table class="purchase-summary">
                    <tr class="purchase-summary__price">
                        <th> 商品代金</th>
                        <td>{{ number_format($item->price) }}</td>
                    </tr>
                    <tr class="purchase-summary__payment-method">
                        <th>支払い方法</th>
                        <td>
                            {{ session('payment_method') == 2 ? 'カード支払い' :'コンビニ支払い' }}
                        </td>
                    </tr>
                </table>
                <form action="{{ route('purchase.store', $item->id) }}" class="purchase-form__submit" method="post">
                    @csrf
                    <input type="hidden" name="payment_method" value="{{ session('payment_method') }}">
                    <button type="submit" class="purchase-summary__action">
                        購入する
                    </button>
                </form>
            </section>
        </div>

@endsection