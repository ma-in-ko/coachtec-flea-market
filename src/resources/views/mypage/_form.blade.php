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

            @php
            $fields = [
                'postal_code' => '郵便番号',
                'address' => '住所',
                'building' => '建物名',
            ];
            @endphp

            @foreach($fields as $name => $label)
                <div class="profile-form__group">
                    <label class="profile-form__label">
                        {{ $label }}
                    </label>

                    <input type="text" name="{{ $name }}" class="profile-form__input" value="{{ old($name, optional($profile)->$name ?? '') }}">

                    <x-error :field="$name" />
                </div>
            @endforeach

            <x-button type="submit" class="btn profile-form__update">更新する</x-button>
        </form>
    </section>