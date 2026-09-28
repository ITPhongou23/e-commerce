<x-layout>
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-8">
            Thanh toán
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="border rounded-xl p-6 shadow-sm">

                    <h2 class="text-xl font-semibold mb-6">
                        Thông tin giao hàng
                    </h2>

                    <form action="" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div>
                                <label class="block mb-2 font-medium">
                                    Họ và tên
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ auth()->user()->name ?? '' }}"
                                    class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Nguyễn Văn A"
                                >
                            </div>

                            <div>
                                <label class="block mb-2 font-medium">
                                    Số điện thoại
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="0123456789"
                                >
                            </div>

                        </div>

                        <div class="mt-5">
                            <label class="block mb-2 font-medium">
                                Địa chỉ
                            </label>

                            <input
                                type="text"
                                name="address"
                                class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Số nhà, đường..."
                            >
                        </div>

                        <div class="mt-5">
                            <label class="block mb-2 font-medium">
                                Ghi chú
                            </label>

                            <textarea
                                name="note"
                                rows="4"
                                class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ghi chú cho đơn hàng..."
                            ></textarea>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-xl font-semibold mb-4">
                                Phương thức thanh toán
                            </h2>

                            <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod"
                                    checked
                                >

                                <div>
                                    <p class="font-medium">
                                        Thanh toán khi nhận hàng
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Thanh toán tiền mặt khi nhận được hàng
                                    </p>
                                </div>
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full mt-6 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700"
                        >
                            Đặt hàng
                        </button>

                    </form>

                </div>
            </div>


            <div>
                <div class="border rounded-xl p-6 shadow-sm sticky top-5">

                    <h2 class="text-xl font-semibold mb-5">
                        Đơn hàng của bạn
                    </h2>

                    @php
                        $total = 0;
                    @endphp

                    @foreach($carts as $cart)

                        @php
                            $subtotal = $cart->product->price * $cart->quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="flex justify-between gap-4 py-4 border-b">

                            <div>
                                <p class="font-medium">
                                    {{ $cart->product->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Số lượng: {{ $cart->quantity }}
                                </p>
                            </div>

                            <p class="font-medium whitespace-nowrap">
                                {{ number_format($subtotal) }} đ
                            </p>

                        </div>

                    @endforeach


                    <div class="flex justify-between mt-5">
                        <span class="text-gray-600">
                            Tạm tính
                        </span>

                        <span>
                            {{ number_format($total) }} đ
                        </span>
                    </div>

                    <div class="flex justify-between mt-3">
                        <span class="text-gray-600">
                            Phí vận chuyển
                        </span>

                        <span>
                            Miễn phí
                        </span>
                    </div>

                    <div class="border-t mt-5 pt-5 flex justify-between">
                        <span class="text-lg font-bold">
                            Tổng cộng
                        </span>

                        <span class="text-xl font-bold text-blue-600">
                            {{ number_format($total) }} đ
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layout>