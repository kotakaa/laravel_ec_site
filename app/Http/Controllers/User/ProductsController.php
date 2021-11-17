<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function top()
    {
        $products = Product::all();
        return view('user.products.top')
            ->with('products', $products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $tax_price = 1.10;
        return view('user.products.show')
            ->with('product', $product)
            ->with('tax_price', $tax_price);
    }
}
