<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductDownloadController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $hasAccess = $request->user()
            ->orders()
            ->with('products')
            ->get()
            ->pluck('products')
            ->flatten()
            ->contains('id', $product->id);

        if (! $hasAccess) {
            throw new ModelNotFoundException;
        }

        return Storage::disk('public')->download($product->file_path);
    }
}
