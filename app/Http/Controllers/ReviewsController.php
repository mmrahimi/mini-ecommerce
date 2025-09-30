<?php

namespace App\Http\Controllers;

use App\Events\ReviewSubmitted;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function create(Product $product)
    {
        if (! auth()->user()->can('create', [Review::class, $product])) {
            abort(403, 'Unauthorized action.');
        }

        return view('reviews.create', compact('product'));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->input('product_id'));

        if (! auth()->user()->can('create', [Review::class, $product])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $request->user()->reviews()->create([
            'rating' => $request->input('rating'),
            'product_id' => $request->input('product_id'),
        ]);

        $product = Product::find($request->input('product_id'));

        event(new ReviewSubmitted($product));

        return redirect()->route('products.show', $product->slug);
    }
}
