
    <section class="card">
        <form action="/mypage/profile" class="profile-form" method="post" enctype="multipart/form-data">
        @csrf

            <h2 class="profile-form__title">プロフィール設定</h2>

            <!--  プロフィール画像  -->
            <div class="profile-form__group">
                <div class="image-upload">
                    <img src="#" class="profile-form__image" alt="">
                    <button class="profile-form__select">画像を選択する</button>
                    @error('image')
                    <p class="error-message">{{ $message}}</P>
                    @enderror
                </div>
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">ユーザー名</label>
                <input type="text" name="name" class="profile-form__input">
                @error('name')
                    <p class="error-message">{{ $message}}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">郵便番号</label>
                <input type="text" name="postal_code" class="profile-form__input">
                @error('postal_code')
                    <p class="error-message">{{ $message}}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">住所</label>
                <input type="text" name="address" class="profile-form__input">
                @error('address')
                    <p class="error-message">{{ $message}}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">建物名</label>
                <input type="text" name="building" class="profile-form__input">
                @error('building')
                    <p class="error-message">{{ $message}}</P>
                @enderror
            </div>
            <button type="submit" class="profile-form__select">更新する</button>
        </form>