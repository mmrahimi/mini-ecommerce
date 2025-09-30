<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);

        return view('admin.index', compact('products'));
    }
}
