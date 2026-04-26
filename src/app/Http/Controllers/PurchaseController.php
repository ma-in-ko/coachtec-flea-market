<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\Profile;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class PurchaseController extends Controller
{
    /*購入*/
    public function create(Item $item)
    {
        //DBで購入済チェック
        if (Purchase::where('item_id', $item->id)->exists()) {
            abort(403, 'この商品はすでに購入されています');
        }

        //自分の商品チェック
        if($item->user_id === auth()->id()) {
            abort(403, '自分の商品は購入できません');
        }

        //初期支払い方法
        if (!session()->has('payment_method')) {
            session(['payment_method' => 1]);
        }

        $user = auth()->user();
        $profile = $user->profile;

        return view('purchase.confirm', [
            'item' => $item,
            'postal_code' => session('postal_code') ?? $profile->postal_code ?? '',
            'address' => session('address') ?? $profile->address ?? '',
            'building' => session('building') ?? $profile->building ?? '',
           ]);
    }


    /*支払い方法*/
    public function payment(Request $request, Item $item)
    {
        session(['payment_method' => $request->payment_method]);
        return redirect()->route('purchase.create', $item->id);
    }

    /*配送先変更*/
    public function edit(Item $item)
    {
        return view ('purchase.address_edit', compact('item'));
    }

    public function update(AddressRequest $request, Item $item)
    {
        session([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building
        ]);

        return redirect()->route('purchase.create', $item->id);
    }

    /*購入確定*/
    public function store(PurchaseRequest $request, Item $item)
    {
        //支払い方法
        $payment_method = $request->payment_method;

        //DBロック
        $item = Item::lockForUpdate()->findOrFail($item->id);

        //購入済みチェック
        if (Purchase::where('item_id', $item->id)->exists()) {
            return back()->withErrors(['items' => 'すでに購入済です']);
        }

        //出品した商品は購入できない
        if ($item->user_id === auth()->id()) {
            return back()->withErrors(['item' => '自分の商品は購入できません']);
        }


        //コンビニ支払い
        if($payment_method == 1) {

            DB::transaction(function () use ($item, $payment_method) {

                //購入情報保存
                $profile = auth()->user()->profile;

                Purchase::create([
                    'user_id' => auth()->id(),
                    'item_id' => $item->id,
                    'payment_method' => $payment_method,
                    'postal_code' => session('postal_code') ?? $profile->postal_code,
                    'address' => session('address') ?? $profile->address,
                    'building'=> session('building') ?? $profile->building,
                ]);

            });

            session()->forget(['postal_code', 'address', 'building']);

            return redirect('/')->with('message', '購入が完了しました');
        }

        //カード支払い
        if($payment_method == 2) {

            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $item->name,
                        ],
                        'unit_amount' => (int)$item->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('purchase.success', ['item' => $item->id]),
                'cancel_url' =>route('purchase.create', ['item' => $item->id]),
            ]);

            return redirect($session->url);
        }

        return back()->withErrors(['payment_method' => '支払い方法がエラーです']);
    }

    public function success($itemId)
    {

        DB::transaction(function () use($itemId) {

            $item = Item::lockForUpdate()->findOrFail($itemId);

            //購入済みチェック
            if (Purchase::where('item_id', $item->id)->exists()) {
                throw new \Exception('すでに購入されています');
            }

            //出品した商品は購入できない
            if ($item->user_id === auth()->id()) {
                throw new \Exception('自分の商品は購入できません');
            }

            //購入データ保存
            $profile = auth()->user()->profile;

            Purchase::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'price' => $item->price,
                'payment_method' =>session('payment_method', 1),
                'postal_code' => session('postal_code') ?? $profile->postal_code,
                'address' => session('address') ?? $profile->address,
                'building' =>session('building') ?? $profile->building,
            ]);

        });

        session()->forget(['postal_code', 'address', 'building']);

        return redirect('/')->with('message', '購入が完了しました');
    }
}