<x-layout title="Register">
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="flex min-h-[70vh] items-center justify-center px-4 py-5">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-blue-400 p-8 shadow-lg">

            <h1 class="mb-6 text-center text-3xl font-bold text-white">
                Đăng ký
            </h1>

            <form method="POST" action="/register" class="space-y-5">
                @csrf
                <div class="flex flex-col">
                    <label for="username" class="mb-2 font-semibold text-white">
                        Tên đăng nhập
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Tên đăng nhập">
                </div>

                <div class="flex flex-col">
                    <label for="email" class="mb-2 font-semibold text-white">
                        Email
                    </label>

                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Email">
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-2 font-semibold text-white">
                        Mật khẩu
                    </label>

                    <input type="password" id="password" name="password" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Mật khẩu">
                </div>

                <div class="flex flex-col">
                    <label for="password_confirmation" class="mb-2 font-semibold text-white">
                        Nhập lại mật khẩu
                    </label>

                    <input type="password" id="password_confirmation" name="password_confirmation" required class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300" placeholder="Nhập lại mật khẩu">
                </div>

                <button type="submit" class="w-full rounded-lg bg-[#a3b2bb] px-4 py-3 font-bold text-white transition hover:bg-[#8f9fa8] focus:outline-none focus:ring-2 focus:ring-white">
                    Đăng ký
                </button>
            </form>

            <p class="mt-6 text-center text-white">
                Bạn đã có tài khoản?
                <a href="{{ route('login') }}" class="font-semibold text-yellow-300 hover:underline">
                    Đăng nhập
                </a>
            </p>
        </div>
    </div>
</x-layout>