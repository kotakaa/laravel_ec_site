<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Product;

class ReviewsController extends Controller
{
    public function create($id)
    {
        $product_id = $id;
        return view('user.products.reviews.create')
            ->with('product_id', $product_id);
    }

    public function store(ReviewRequest $request, $product_id)
    {
        $user = Auth::user();
        $product = Product::find($product_id);
        $tax_price = 1.10;

        \DB::beginTransaction();
            try{
                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product_id,
                    'rate' => $request['rate'],
                    'comment' => $request['comment'],
                ]);
                \DB::commit();
            }catch(\Throwable $e){
                \DB::rollback();
                return view('user.products.reviews.create')
                    ->with('product_id', $product_id)
                    ->with('status', 'レビューを作成できませんでした。');
            }

        $reviews = $product->reviews;

        return view('user.products.show')
            ->with('product', $product)
            ->with('reviews', $reviews)
            ->with('tax_price', $tax_price);
    }

    public function destroy($product_id, $id)
    {
        $product = Product::find($product_id);
        $review = Review::find($id);
        $review->delete();

        $tax_price = 1.10;
        $reviews = $product->reviews;

        return view('user.products.show')
        ->with('product', $product)
        ->with('reviews', $reviews)
        ->with('tax_price', $tax_price)
        ->with('status', 'レビューを削除しました');
    }
}
