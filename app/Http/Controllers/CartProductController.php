<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartProductController extends Controller
{
    public function store()
    {
        $product = Product::findOrFail(request('product_id'));

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'session_id' => session()->getId(),
        ]);

        $cart->products()->syncWithoutDetaching($product);

        return back();
    }

    public function destroy(Product $product)
    {
        Cart::bySession()->first()->products()->detach($product);

        return back();
    }
}
