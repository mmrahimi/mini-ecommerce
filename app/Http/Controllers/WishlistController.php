<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->with('products')->first();
        $wishlistItems = $wishlist?->products ?? collect();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Product $product)
    {
        $user = auth()->user();

        $wishlist = $user->wishlist ?? $user->wishlist()->create();

        $isFavorite = $wishlist->products()->where('product_id', $product->id)->exists();

        if ($isFavorite) {
            $wishlist->products()->detach($product);
        } else {
            $wishlist->products()->attach($product);
        }

        return redirect()->back();
    }
}
