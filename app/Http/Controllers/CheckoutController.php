<?php

namespace App\Http\Controllers;

use App\Notifications\ThankYouForYourPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'cvv' => 'required|numeric|digits:3',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha does not match.',
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('http://localhost:3000/pay', $request->only('card_number', 'cvv'));

        if ($response->ok()) {
            $user = auth()->user();
            $cart = $user->cart;

            $order = $user->orders()->create();
            $order->products()->attach($cart->products);

            $data = [
                'subject' => 'Thank you for your order',
                'message' => "We've received your order successfully.",
            ];

            $user->notify(new ThankYouForYourPurchase($data));

            $cart->fresh()->delete();

            return redirect()->route('home')->with('success', 'Order placed successfully.');
        } else {
            return back()->with(['error' => 'Payment failed']);
        }
    }
}
