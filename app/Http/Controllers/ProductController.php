<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $productRatingByUser = auth()->user()?->reviews()?->where('product_id', $product->id)->first()?->rating;
        $isFavorite = auth()->user()?->wishlist?->products?->contains($product->id);

        return view('products.show', compact('product', 'productRatingByUser', 'isFavorite'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255|unique:products,slug',
            'description' => 'required|string|min:3|max:255',
            'price' => 'required|integer|min:1',
            'image' => 'required|file|max:2048',
            'file_path' => 'required|file|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');
        $productFilePath = $request->file('file_path')->store('products', 'public');

        Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => basename($imagePath),
            'file_path' => $productFilePath,
            'rating' => 0,
        ]);

        return redirect()->route('admin.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => ['required', 'string', 'min:3', 'max:255', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => 'required|string|min:3|max:255',
            'price' => 'required|integer|min:1',
            'image' => 'nullable|file|max:2048',
            'file_path' => 'nullable|file|max:2048|mimes:zip,rar,pdf',
        ]);

        if ($request->file('image')) {
            Storage::disk('public')->delete('images/'.$product->image_url);
            $imagePath = $request->file('image')->store('images', 'public');
        }

        if ($request->file('file_path')) {
            Storage::disk('public')->delete($product->file_path);
            $productFilePath = $request->file('file_path')->store('products', 'public');
        }

        $product->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => isset($imagePath) ? basename($imagePath) : $product->image_url,
            'file_path' => $productFilePath ?? $product->file_path,
        ]);

        return redirect()->route('admin.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        Storage::disk('public')->delete('images/'.$product->image_url);
        Storage::disk('public')->delete($product->file_path);

        return redirect()->route('admin.index');
    }
}
