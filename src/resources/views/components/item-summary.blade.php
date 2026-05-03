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
        @php
            $liked = $item->likes->where('user_id', auth()->id())->count();
        @endphp
        <div class="item-detail__likes">
            @if($liked)
                <form action="/item/{{ $item->id }}/like" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="link-btn">
                        <img class="icon" src="{{ asset('images/heart-pink.png') }}" alt="いいねアイコン">
                    </button>
                </form>
            @else

                <form action="/item/{{ $item->id }}/like" method="POST">
                    @csrf
                    <button type="submit" class="link-btn">
                        <img class="icon" src="{{ asset('images/heart-default.png') }}" alt="いいね">
                    </button>
                </form>
            @endif

                <p  class="item-detail__likes-count">
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

    @if(!$item->purchase)
        <a href="{{ route('purchase.create', $item->id) }}" class="btn item-detail__purchase">
            購入手続きへ
        </a>
    @else
        <span class="sold-text">売り切れ</span>
    @endif
</article>