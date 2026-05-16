<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AuthController;

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
Route::get('/', [ItemController::class, 'index'])->name('items.index');
/*マイリスト*/
Route::get('/mylist',[ItemController::class,'mylist'])->name('items.mylist');
/*詳細画面*/
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');


/*認証機能必須*/
Route::middleware('auth', 'verified')->group(function() {

    /*出品*/
    Route::get('/sell', [ItemController::class, 'create'])->name('sell.create');
    Route::post('/sell',[ItemController::class, 'store'])->name('sell.store');

    /*コメント関連*/
    /*投稿*/
    Route::post('/item/{item}/comment', [CommentController::class, 'store'])->name('comments.store');

    /*いいね関連*/
    /*追加*/
    Route::post('/item/{item}/like', [LikeController::class, 'store'])->name('likes.store');

    /*解除*/
    Route::delete('/item/{item}/like', [LikeController::class, 'destroy'])->name('likes.destroy');

    /*購入関連*/
    /*購入*/
    Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->name('purchase.create');

    /*支払い方法*/
    Route::post('purchase/payment/{item}', [PurchaseController::class, 'payment'])->name('purchase.payment');

    /*配送先変更*/
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'edit'])->name('purchase.address.edit');
    Route::put('/purchase/address/{item}', [PurchaseController::class, 'update'])->name('purchase.address.update');
    Route::post('purchase/address/{item}', [PurchaseController::class, 'resetAddress'])->name('purchase.address.reset');

    /*購入確定（コンビニ）*/
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');

    /*購入確定（カード）*/
    Route::get('/purchase/success/{item}', [PurchaseController::class,'success'])->name('purchase.success');

    /*マイページ関連*/
    /*プロフィール画面*/
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    /*変更*/
    Route::get('/mypage/profile', [MypageController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [MypageController::class, 'update'])->name('profile.update');
    /*変更画面*/
    Route::get('/mypage/form', function() {
        return view('mypage._form');
    });
});