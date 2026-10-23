<x-layout title="{{ $product->name }}">
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="mt-5 mx-10 items-start text-gray-500 hover:text-blue-600">
        <a href="/">
            ← Quay lại trang chủ
        </a>
    </div>  

    <div class="mx-auto max-w-6xl px-6 py-10">
        <div class="flex overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg lg:flex-row ">
            <div class="flex min-h-[500px] w-full items-center justify-center bg-gray-50 lg:w-1/2">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-[420px] w-[420px] object-contain">
            </div>

            <div class="flex w-full flex-col justify-center p-10 lg:w-1/2 lg:p-12">
                <h1 class="text-4xl font-bold text-gray-900">
                    {{ $product->name }}
                </h1>

                <div class="mt-5">
                    <span class="text-3xl font-bold text-green-600">
                        {{ number_format($product->price, 2) }} ₫
                    </span>
                </div>

                <div class="mt-8 border-y border-gray-200 py-6">
                    <div class="flex items-center justify-between py-3">
                        <span class="text-gray-500">
                            Số lượng
                        </span>

                        <span class="font-semibold text-gray-900">
                            {{ $product->stock }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <span class="text-gray-500">
                            Tình trạng
                        </span>

                        @if ($product->stock > 0)
                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                Còn hàng
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                Hết hàng
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-bold text-gray-900">
                        Mô tả sản phẩm
                    </h2>

                    <p class="mt-3 leading-7 text-gray-600">
                        {{ $product->description ?: 'Chưa có mô tả cho sản phẩm này.' }}
                    </p>
                </div>

                @if ($product->stock > 0)
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('buy-to-product', ['productId' => $product->id]) }}" class="w-full rounded-xl bg-blue-600 px-6 py-4 text-center font-bold text-white transition hover:bg-blue-700">
                            Mua ngay
                        </a>

                        <form action="{{ route('add-to-cart', ['productId' => $product->id]) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full rounded-xl bg-gray-200 py-4 font-bold text-gray-700 transition hover:bg-gray-300">
                                + Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-8 flex gap-4">
                        <button type="button" disabled class="w-full cursor-not-allowed rounded-xl bg-blue-400 px-6 py-4 text-center font-bold text-white opacity-50">
                            Tạm hết hàng
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>