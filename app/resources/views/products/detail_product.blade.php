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

    <div class="mx-auto max-w-6xl px-6 py-10">
        <h2 class="mb-6 text-2xl font-bold text-gray-900">Đánh giá sản phẩm</h2>
        {{-- đánh giá --}}
        <div class="space-y-4">
            @forelse ($reviews as $review)
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <p class="font-bold">
                                {{ $review->user->name}}
                            </p>
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $review->rating)
                                    <span style="color: orange;">★</span>
                                @else
                                    <span style="color: #d1d5db;">★</span>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs text-gray-400">
                            {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                        </span>
                    </div>
                    <p class="mt-2 ml-4 text-gray-700">
                        - {{ $review->comment }}
                    </p>
                </div>
            @empty
            <div class="flex justify-center">
                <p class="text-gray-500 italic">Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá!</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6 flex justify-end">
            <button onclick="openReviewModal()"
                class="rounded-lg bg-red-600 px-4 py-2 font-semibold text-white">
                Thêm đánh giá
            </button>
        </div>

        <form id="reviewForm" action="{{ route('reviews.store', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="reviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4">
                <div class="w-full max-w-xl overflow-hidden rounded-xl bg-white shadow-xl">
                    <div class="flex items-center justify-between border-b px-5 py-4">
                        <h2 class="text-xl font-bold">Đánh giá & nhận xét</h2>
                        <button type="button" onclick="closeReviewModal()"
                            class="text-2xl text-gray-500 hover:text-black">&times;</button>
                    </div>

                    <div class="p-5">
                        <h3 class="mb-6 text-lg font-semibold">{{ $product->name }}</h3>

                        <p class="mb-3 font-bold">Đánh giá chung</p>
                        <div class="mb-6 flex justify-between text-center" onmouseleave="resetRating()">
                            <input type="hidden" name="rating" id="ratingValue" value="1">

                            @foreach ([1 => 'Rất tệ', 2 => 'Tệ', 3 => 'Bình thường', 4 => 'Tốt', 5 => 'Tuyệt vời'] as $star => $label)
                                <button type="button"
                                        onclick="selectRating({{ $star }})"
                                        onmouseenter="previewRating({{ $star }})"
                                        class="flex flex-col items-center cursor-pointer focus:outline-none">
                                    <span id="star{{ $star }}" class="text-3xl {{ $star <= 1 ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-150">★</span>
                                    <span class="text-sm text-gray-600 mt-1">{{ $label }}</span>
                                </button>
                            @endforeach
                        </div>

                        <p class="mb-3 font-bold">Nội dung đánh giá</p>
                        <textarea id="reviewContent" name="comment" rows="5"
                            placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm..."
                            class="w-full rounded-lg border p-3 outline-none focus:border-blue-500"></textarea>

                        <div class="mt-4 flex justify-center">
                            <label class="cursor-pointer rounded-lg border border-dashed w-full p-4 text-center text-gray-500">
                                Thêm hình ảnh
                                <input type="file" name="images[]" accept="image/*" multiple class="hidden">
                            </label>
                        </div>
                    </div>

                    <div class="border-t p-4 flex justify-center">
                        <button type="submit"
                            class="rounded-lg bg-red-600 py-3 px-5 font-bold text-white hover:bg-red-700">
                            GỬI ĐÁNH GIÁ
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    

    <div class="mx-auto max-w-6xl px-6 py-10">
        <h2 class="mb-6 text-2xl font-bold text-gray-900">Hỏi đáp</h2>

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <form action="{{ route('add-comment', $product) }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="content" class="mb-2 block font-semibold text-gray-700">Hãy đặt câu hỏi cho chúng tôi</label>
                    <textarea name="content" id="content" rows="3" required placeholder="Viết câu hỏi của bạn..." class="w-full rounded-lg border border-gray-300 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>

                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">
                    Gửi câu hỏi
                </button>
            </form>
        @else
            <div class="mb-6 rounded-lg bg-gray-100 p-4 text-center">
                <p class="text-gray-600">
                    Vui lòng <a href="{{ route('login') }}" class="font-bold text-blue-600 underline">đăng nhập</a> để tham gia bình luận.
                </p>
            </div>
        @endauth

        {{-- Danh sách bình luận --}}
        <div class="space-y-4">
            @forelse ($comments as $comment)
                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        {{-- Sửa lại lấy tên qua quan hệ user --}}
                        <p class="font-semibold text-gray-900">
                            {{ $comment->user->name ?? 'Người dùng ẩn danh' }}
                        </p>
                        <span class="text-xs text-gray-400">
                            {{ $comment->created_at ? $comment->created_at->diffForHumans() : '' }}
                        </span>
                    </div>

                    <p class="mt-2 text-gray-700">
                        {{ $comment->content }}
                    </p>
                </div>
            @empty
            <div class="flex justify-center">
                <p class="text-gray-500 italic">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
            </div>
            @endforelse
        </div>
    </div>
</x-layout>