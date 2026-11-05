<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(Request $request, Product $product)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $product->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    // Test API
    public function comment(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'content'    => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id'    => $request->user()->id,
            'product_id' => $validated['product_id'],
            'content'    => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tạo bình luận thành công.',
            'data'    => $comment,
        ], 201);
    }
}