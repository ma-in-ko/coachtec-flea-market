<li class="item">
    <a href="/item/{{ $item->id }}" class="item__link">
        <div class="item__image-wrapper">
            <img class="item__image" src="{{ $item->image }}" alt="商品画像">
        </div>
        <p class="item__name">{{ $item->name }}</p>
    </a>
</li>