@php use Illuminate\Support\Str; @endphp

<li class="item">
    <a href="/item/{{ $item->id }}" class="item__link">
        <div class="item__image-wrapper">
            @if (Str::startsWith($item->image, 'http'))
                <img class="item__image" src="{{ $item->image }}" alt="商品画像">
            @else
                <img class="item__image" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
            @endif

            @if($item->purchase)
                <span class="item__sold">SOLD</span>
            @endif
        </div>
        <p class="item__name">{{ $item->name }}</p>
    </a>
</li>