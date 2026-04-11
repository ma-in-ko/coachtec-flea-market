<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;


use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\LogoutResponse as CustomLogoutResponse;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // ユーザー作成
        Fortify::createUsersUsing(CreateNewUser::class);

        // プロフィール更新
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);

        // パスワード更新
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        // パスワードリセット
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 会員登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });


        // ログイン処理
        Fortify::authenticateUsing(function (Request $request) {

            // FormRequestバリデーション
            app(\App\Http\Requests\LoginRequest::class)->validateResolved();

            // ユーザー取得
            $user = User::where('email', $request->email)->first();

            // 認証チェック
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['ログイン情報が登録されていません'],
                ]);
            }

            return $user;
        });

        // ログイン試行制限（なし）
        RateLimiter::for('login', function (Request $request) {
            return Limit::none();
        });

        // ログイン後のリダイレクト先
        config(['fortify.home' => '/']);


        //ログアウト後のリダイレクト先
        $this->app->instance(LogoutResponse::class, new CustomLogoutResponse());
    }
}