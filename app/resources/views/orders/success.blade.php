<x-layout>
    <div class="mx-auto max-w-lg p-6 text-center">
        <div class="border border-xm p-10">
            <h1 class="text-2xl font-bold text-green-600">Đặt hàng thành công!</h1>
            <p>Tổng tiền: {{ number_format($order->total) }}đ</p>
        </div>
        <div class="mt-4">
            <a href="{{ route('index') }}">
                Về trang chủ
            </a>
        </div>
    </div>
</x-layout>