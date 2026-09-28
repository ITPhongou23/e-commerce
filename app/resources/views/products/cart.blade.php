<x-layout>
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="mx-auto max-w-6xl px-4">
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h1 class="mb-8 text-3xl font-bold text-gray-800">
                Giỏ hàng
            </h1>

            @if($carts->isEmpty())
                <div class="rounded-xl bg-white p-10 text-center shadow-sm">
                    <h2 class="text-xl font-semibold text-gray-700">
                        Giỏ hàng đang trống
                    </h2>
                    <p class="mt-2 text-gray-500">
                        Hãy thêm sản phẩm vào giỏ hàng.
                    </p>
                    <a href="{{ route('index') }}" class="mt-6 inline-block rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700">
                        Tiếp tục mua sắm
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div class="space-y-4 lg:col-span-2">
                        @foreach($carts as $cart)
                            <div class="rounded-xl bg-white p-5 shadow-sm">
                                <div class="flex items-center gap-5">
                                    <div class="flex-1">
                                        <h2 class="text-lg font-semibold text-gray-800">
                                            {{ $cart->product->name }}
                                        </h2>

                                        <p class="mt-2 font-semibold text-blue-600">
                                            {{ number_format($cart->product->price) }} ₫
                                        </p>
                                    </div>

                                    <div class="flex items-center rounded-lg border border-gray-300">
                                        <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="action" value="decrease">

                                            <button type="submit"
                                                    class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                                −
                                            </button>
                                        </form>

                                        <span class="px-4 py-2 font-medium">
                                            {{ $cart->quantity }}
                                        </span>

                                        <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="action" value="increase">

                                            <button type="submit"
                                                    class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                                +
                                            </button>
                                        </form>
                                    </div>

                                   <form action="{{ route('delete-to-cart', ['cartId' => $cart->id]) }}" method="POST">
                                        @csrf

                                        <button type="submit"
                                                class="px-3 py-2 text-red-600 hover:bg-red-100">
                                            Xóa
                                        </button>
                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    <div class="h-fit rounded-xl bg-white p-6 shadow-sm">
                        <h2 class="mb-6 text-xl font-bold text-gray-800">
                            Tổng đơn hàng
                        </h2>

                        @php
                            $total = $carts->sum(function ($cart) {
                                return $cart->product->price * $cart->quantity;
                            });
                        @endphp

                        <div class="flex justify-between border-b border-gray-200 pb-5 text-gray-600">
                            <span>Tạm tính</span>

                            <span>
                                {{ number_format($total) }} ₫
                            </span>
                        </div>

                        <div class="flex justify-between py-5">
                            <span class="text-lg font-semibold">
                                Tổng cộng
                            </span>

                            <span class="text-xl font-bold text-blue-600">
                                {{ number_format($total) }} ₫
                            </span>
                        </div>
                        
                        <div class="flex justify-between py-5">
                            <a href="{{ route('buy') }}" class="w-full rounded-lg bg-blue-600 py-3 text-center font-semibold text-white hover:bg-blue-700">
                                Tiến hành thanh toán
                            </a>
                        </div>
                    </div>

                </div>

            @endif

        </div>
    </div>

</x-layout>