<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function update(Request $request, Cart $cart)
    {
        if ($request->action === 'increase') {
            $cart->quantity++;
        }

        if ($request->action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity--;
            }
        }

        $cart->save();

        return redirect()->back();
    }

    public function index()
    {
        $products = Product::all();

        return view('index', [
            'products' => $products,
        ]);
    } 

    public function getUserCart()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('products.cart', compact('carts'));
    }

    public function addToCart($productId)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart');
    }

    public function deleteToCart($cartId)
    {
        $cart = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart');
    }
}