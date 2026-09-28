<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\CartController;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('index', [
            'products' => $products,
        ]);
    } 

    public function buyToProduct($productId){
        if (Auth::check()){
            app(CartController::class)->addToCart($productId);
        
            return redirect()->route('buy');
        }
        else{
            return back()->withErrors(['error' => 'Vui lòng đăng nhập.'])->withInput();
        }   
    }

    public function detailproduct($productId){
        $product = Product::where('id',$productId)->first();

        return view('products.detail_product', compact('product'));
    }
}