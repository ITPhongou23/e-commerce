<x-layout title="Login">
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="flex min-h-[70vh] items-center justify-center px-4 mb-10">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-blue-400 p-8 shadow-lg">


            {{-- Tiêu đề --}}
            <h1 class="mb-6 text-center text-3xl font-bold text-white">
                Login
            </h1>

            <form method="POST" class="space-y-5" action="{{ route('login') }}">
                @csrf

                {{-- name --}}
                <div class="flex flex-col">
                    <label for="name" class="mb-2 font-semibold text-white">
                        Username
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                        placeholder="Enter your name"
                    >
                </div>

                {{-- Password --}}
                <div class="flex flex-col">
                    <label for="password" class="mb-2 font-semibold text-white">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                        placeholder="Enter your password"
                    >
                </div>

                {{-- Login button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-[#a3b2bb] px-4 py-3 font-bold text-white transition hover:bg-[#8f9fa8] focus:outline-none focus:ring-2 focus:ring-white"
                >
                    Login
                </button>
            </form>

            {{-- Register --}}
            <p class="mt-6 text-center text-white">
                Don't have an account?
                <a
                    href="{{ route('register') }}"
                    class="font-semibold text-yellow-300 hover:underline"
                >
                    Register
                </a>
            </p>

        </div>
    </div>
</x-layout>