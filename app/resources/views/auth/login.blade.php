<x-layout title="Login">
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="flex min-h-[70vh] items-center justify-center px-4 mb-20">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-blue-400 p-8 shadow-lg py-10">
            <h1 class="mb-6 text-center text-3xl font-bold text-white">
                Đăng nhập
            </h1>

            <form method="POST" class="space-y-5" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col">
                    <label for="name" class="mb-2 font-semibold text-white">
                        Tên đăng nhập
                    </label>

                    <input type="text" id="name" name="name" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Tên đăng nhập">
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-2 font-semibold text-white">
                        Mật khẩu
                    </label>

                    <input type="password" id="password" name="password" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Mật khẩu">
                </div>

                <button type="submit" class="w-full rounded-lg bg-[#a3b2bb] px-4 py-3 font-bold text-white transition hover:bg-[#8f9fa8] focus:outline-none focus:ring-2 focus:ring-white">
                    Đăng nhập
                </button>
            </form>

            <p class="mt-6 text-center text-white">
                Bạn chưa có tài khoản?
                <a href="{{ route('register') }}" class="font-semibold text-yellow-300 hover:underline">
                    Đăng ký
                </a>
            </p>
        </div>
    </div>
</x-layout>