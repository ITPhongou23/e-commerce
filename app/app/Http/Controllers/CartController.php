<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function getUserCart(){
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('products.cart', compact('carts'));
    }

    public function addToCart($productId){
        if (Auth::check()){
            $cart = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();

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
        else{
            return back()->withErrors([
                'name' => 'Vui lòng đăng nhập.',
            ])->withInput();
        }       
    }

    public function updateCart(Request $request, Cart $cart){
        if ($request->action === 'increase') {
            $cart->quantity++;
        }

        if ($request->action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity--;
            }
            else{
                return back()->withErrors(['error' => 'Vui lòng bấm xoá',])->withInput();
            }
        }

        $cart->save();

        return redirect()->back();
    }

    public function deleteToCart($cartId){
        $cart = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart');
    }

    public function buyToCart(){
        $carts = Cart::where('user_id', Auth::id())->all();

        if ($carts) {
            $carts->delete();

            return back()->with('Success','Đặt đơn thành công.');
        }
        else{
            return back()->withErrors(['error','Bạn chưa có sản phẩm trong giỏ hàng.'])->withInput();
        }
    }

    public function getUserBuyCart(){
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('products.buy', compact('carts'));
    }
}