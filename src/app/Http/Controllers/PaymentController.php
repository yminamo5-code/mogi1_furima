<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Item;

class PaymentController extends Controller
{
    public function store(PurchaseRequest $request)
    {
        $item = Item::findOrFail($request->item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card', 'konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->itemname,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            'success_url' => route('payment.success', [
                'item_id' => $item->id,
                'paymethod' => $request->payment_method
            ]),

            'cancel_url' => route('item.show', $item->id),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
            'paymethod' => $request->paymethod
        ]);

        return redirect('/');
    }
}
