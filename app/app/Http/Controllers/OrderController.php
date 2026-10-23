<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index_order_admin(Request $request)
    {
        $orders = Order::latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect('/')->with('error', 'Giỏ hàng đang trống');
        }

        return view('products.buy', compact('carts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:500',
            'description' => 'nullable|string|max:1000',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect('/')->with('error', 'Giỏ hàng đang trống');
        }

        $order = DB::transaction(function () use ($data, $carts) {
            $total = 0;

            $order = Order::create([
                'user_id'     => auth()->id(),
                'name'        => $data['name'],
                'phone'       => $data['phone'],
                'address'     => $data['address'],
                'description' => $data['description'] ?? null,
                'total'       => 0, 
            ]);

            foreach ($carts as $cart) {
                $product = Product::lockForUpdate()->find($cart->product_id);

                if (!$product || $product->stock < $cart->quantity) {
                    throw ValidationException::withMessages([
                        'stock' => 'Sản phẩm "' . ($product->name ?? 'không tồn tại') . '" không đủ hàng.',
                    ]);
                }

                $order->items()->create([
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'quantity'   => $cart->quantity,
                    'price'      => $product->price,
                ]);

                $product->decrement('stock', $cart->quantity);

                $total += $product->price * $cart->quantity;
            }

            $order->update(['total' => $total]);

            Cart::where('user_id', auth()->id())->delete();

            return $order;
        });

        return redirect()->route('orders.success', $order);
    }


    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }
}