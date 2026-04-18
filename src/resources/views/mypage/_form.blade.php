
    <section class="card">
        <form action="{{ route('profile.update') }}" class="profile-form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <h2 class="profile-form__title">プロフィール設定</h2>

            <!--  プロフィール画像  -->
            <div class="profile-form__group">
                <div class="image-upload">
                    <img src="{{ $profile->image ? asset('storage/' . $profile->image) : 'default.png' }}" class="profile-form__image" alt="">
                    <label class="profile-form__select">
                        画像を選択する
                        <input type="file" name="image" class="profile-form__select" hidden>
                    </label>
                    @error('image')
                    <p class="error-message">{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">ユーザー名</label>
                <input type="text" name="name" class="profile-form__input"
                value="{{ old('name', $user->name) }}">
                @error('name')
                    <p class="error-message">{{ $message }}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">郵便番号</label>
                <input type="text" name="postal_code" class="profile-form__input"
                value="{{ old('postal_code', $profile->postal_code ?? '') }}">
                @error('postal_code')
                    <p class="error-message">{{ $message }}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-''form__label">住所</label>
                <input type="text" name="address" class="profile-form__input"
                value="{{ old('address', $profile->address ?? '') }}">
                @error('address')
                    <p class="error-message">{{ $message }}</P>
                @enderror
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">建物名</label>
                <input type="text" name="building" class="profile-form__input"
                value="{{ old('building', $profile->building ??'') }}">
                @error('building')
                    <p class="error-message">{{ $message }}</P>
                @enderror
            </div>
            <button type="submit" class="profile-form__update">更新する</button>
        </form>