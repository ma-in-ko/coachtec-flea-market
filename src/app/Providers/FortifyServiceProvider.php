<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\VerifyEmailResponse;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\LogoutResponse as CustomLogoutResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;
use App\Http\Responses\VerifyEmailResponse as CustomVerifyEmailResponse;


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

        $this->app->singleton(
            RegisterResponse::class,
            CustomRegisterResponse::class
        );

        $this->app->singleton(
            VerifyEmailResponse::class,
            CustomVerifyEmailResponse::class
        );

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

        //  認証画面
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        // ログイン試行制限を無効化
        RateLimiter::for('login', function (Request $request) {
            return Limit::none();
        });

        // ログイン後のリダイレクト先
        config(['fortify.home' => '/mypage/profile']);


        // ログアウト後のリダイレクト先
        $this->app->instance(LogoutResponse::class, new CustomLogoutResponse());
    }
}