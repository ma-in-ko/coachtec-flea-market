<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*商品関連*/
/*一覧画面*/
Route::get('/', [ItemController::class, 'index']);
/*詳細画面*/
Route::get('/item/{item}', [ItemController::class, 'show']);


//会員関連
//登録
//Route::get('/register', [AuthController::class, 'create']);
//Route::post('/register', [AuthController::class, 'register']);
/*ログイン*/
//Route::get('/login', [AuthController::class, 'showLogin']);
//Route::post('/login', [AuthController::class, 'login'])->name('login');
/*ログアウト*/
//Route::post('/logout', [AuthController::class, 'logout']);


/*認証機能必須*/
Route::middleware('auth')->group(function() {
    /*出品*/
    Route::get('/sell', [ItemController::class, 'create']);
    Route::post('/sell',[ItemController::class, 'store']);

    /*コメント関連*/
    /*投稿*/
    Route::post('/item/{item}/comment', [CommentController::class, 'store']);

    /*いいね関連*/
    /*追加*/
    Route::post('/item/{item}/like', [LikeController::class, 'store']);

    /*解除*/
    Route::delete('/item/{item}/like', [LikeController::class, 'destroy']);

    /*購入関連*/
    /*購入*/
    Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->name('purchase.create');

    /*支払い方法*/
    Route::post('purchase/payment/{item}', [PurchaseController::class, 'payment'])->name('purchase.payment');

    /*配送先変更*/
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'edit'])->name('purchase.address.edit');
    Route::post('/purchase/address/{item}', [PurchaseController::class, 'update'])->name('purchase.address.update');

    /*購入確定*/
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');


    /*マイページ関連*/
    /*プロフィール画面*/
    Route::get('/mypage', [MypageController::class, 'index']);
    /*変更*/
    Route::get('/mypage/profile', [MypageController::class, 'edit']);
    Route::post('/mypage/profile', [MypageController::class, 'update']);

    Route::get('/verify-test', function() {
        return view('auth.verify-email');
    });

    Route::get('/mypage/form', function() {
        return view('mypage._form');
    });
});