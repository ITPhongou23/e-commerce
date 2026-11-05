<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        if (Review::where('user_id', auth()->id())->where('product_id', $product->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'Bạn đã đánh giá sản phẩm này.']);
        }

        $review = Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
            'rating'     => $data['rating'],
            'comment'    => $data['comment'] ?? null,
        ]);

        return redirect()->route('detail-product', ['productId' => $product->id]);
    }
}