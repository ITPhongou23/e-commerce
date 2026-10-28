<x-layout>
    <div class="min-h-screen">
        @if ($products->count())
            <div class="mt-2 ml-4 flex">
                <form action="/filter" method="GET" >
                    <select id="thuonghieu" name="thuonghieu" class="rounded-2xl" onchange="this.form.submit()">
                        <option value="" disabled selected>-- Chọn thương hiệu --</option>
                        <option value="iPhone">iPhone</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Oppo">Oppo</option>
                        <option value="Xiaomi">Xiaomi</option>
                    </select>
                </form>
                <form action="desc" method="GET">
                    <button class="border border-black-600 p-2 rounded-2xl ml-2 shadow-2xl bg-blue-400">
                        Giá giảm dần
                    </button>
                </form>
                <form action="asc" method="GET">
                    <button class="border border-black-600 p-2 rounded-2xl ml-2 shadow-2xl bg-blue-500">
                        Giá tăng dần
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($products as $product)
                    <div class="flex flex-col items-center rounded-lg border-2 border-gray-300 bg-white p-4 shadow-sm">

                        <img src="{{ $product->image }}"
                            alt="{{ $product->name }}" class="mb-4 w-full rounded-lg object-cover">

                        <a href="{{ route('detail-product', ['productId' => $product->id]) }}" class="font-semibold text-blue-600 hover:underline">
                            {{ $product->name }}
                        </a>

                        <p class="text-green-600">
                            {{ number_format($product->price) }} ₫
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="px-4">
                {{ $products->links() }}
            </div>
        @else
            <p>No products found.</p>
        @endif
    </div>
</x-layout>
