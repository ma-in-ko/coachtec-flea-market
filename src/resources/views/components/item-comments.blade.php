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
                    <img class="comments__avatar" src="{{ $comment->user->profile && $comment->user->profile->image ? asset('storage/' . $comment->user->profile->image) : asset('images/default.png') }}" alt="user-image">
                        <p class="comments__name">{{ $comment->user->name}}</p>
                </div>
                <p class="comments__text">{{ $comment->comment }}</p>
            </li>
        @endforeach
    </ul>

    <div class="comments__form">
        <div class="comments__form-title">商品へのコメント</div>
            <form class="comments__form-text" action="{{ route('comments.store', $item->id) }}" method="POST">
                @csrf
                <textarea name="comment" rows="5">{{ old('comment') }}</textarea>

                <x-error field="comment"/>

                <x-button  class="comments__form-submit" type="submit" >
                    コメントを送信する
                </x-button>
            </form>
    </div>
</article>