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