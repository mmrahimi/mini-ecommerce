<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Product::with('reviews');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
        }

        $products = $query->paginate(6);

        $reviews = $products->mapWithKeys(function ($product) {
            return [$product->id => $product->reviews->count()];
        });

        $ratings = $products->mapWithKeys(function ($product) {
            return [$product->id => $product->reviews->avg('rating') ?? 0];
        });

        return view('home', compact('products', 'ratings', 'reviews'));
    }
}
