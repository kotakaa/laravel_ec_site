<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Genre;

class ProductsController extends Controller
{
    public function top(Request $request)
    {
        $products = Product::all();

        if ($request->filled('keyword')){
            $query = Product::query();
            $keyword = '%'. $request['keyword'] . '%';

            $products = $query->where('name', 'LIKE', $keyword)->get();
        }

        $genres = Genre::all();
        return view('user.products.top')
            ->with('genres', $genres)
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

    public function genreSearch($id)
    {
        $products = Product::where('genre_id', $id)->get();
        $genres = Genre::all();
        return view('user.products.top')
            ->with('genres', $genres)
            ->with('products', $products);
    }
}
