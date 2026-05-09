
    <section class="card">
        <form action="{{ route('profile.update') }}" class="profile-form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <h2 class="profile-form__title">プロフィール設定</h2>

            <!--  プロフィール画像  -->
            <div class="profile-form__group">
                <div class="image-upload">
                    <img src="{{ $profile && $profile->image
                        ? asset('storage/' . $profile->image)
                        : asset('images/default.png') }}"
                        class="profile-form__image" alt="ユーザー画像">
                    <label class="profile-form__select">
                        画像を選択する
                        <input type="file" name="image" class="profile-form__select" hidden>
                    </label>

                    <x-error field="image" />

                </div>
            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">ユーザー名</label>
                <input type="text" name="name" class="profile-form__input"
                value="{{ old('name', $user->name) }}">

                <x-error field="name" />

            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">郵便番号</label>
                <input type="text" name="postal_code" class="profile-form__input"
                value="{{ old('postal_code', $profile->postal_code ?? '') }}">

                <x-error field="postal_code" />

            </div>
            <div class="profile-form__group">
                <label class="profile-''form__label">住所</label>
                <input type="text" name="address" class="profile-form__input"
                value="{{ old('address', $profile->address ?? '') }}">

                <x-error field="address" />

            </div>
            <div class="profile-form__group">
                <label class="profile-form__label">建物名</label>
                <input type="text" name="building" class="profile-form__input"
                value="{{ old('building', $profile->building ??'') }}">

                <x-error field="building" />

            </div>
            <x-button type="submit" class="btn profile-form__update">更新する</x-button>
        </form>