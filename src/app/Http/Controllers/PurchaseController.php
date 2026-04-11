<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\Profile;
use App\Http\Requests\PurchaseRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class PurchaseController extends Controller
{
    /*購入*/
    public function create(Item $item)
    {
        return view('purchase.confirm', compact('item'));
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

    public function update(PurchaseRequest $request, Item $item)
    {
        return redirect()->route('purchase.create', $item->id)->with([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building
        ]);
    }

    /*購入確定*/
    public function store(PurchaseRequest $request, Item $item)
    {
        $payment_method = $request->payment_method;

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

                'success_url' => url('/'),
                'cancel_url' => url()->previous(),
            ]);

        return redirect($session->url);
    }

        return redirect('/');
    }
}