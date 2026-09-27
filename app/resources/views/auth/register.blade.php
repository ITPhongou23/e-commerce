<x-layout title="Register">
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="flex min-h-[70vh] items-center justify-center px-4">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-blue-400 p-8 shadow-lg">

            <h1 class="mb-6 text-center text-3xl font-bold text-white">
                Register
            </h1>

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                {{-- Username --}}
                <div class="flex flex-col">
                    <label for="username" class="mb-2 font-semibold text-white">
                        Username
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                        placeholder="Enter your name"
                    >

                    @error('username')
                        <p class="mt-1 text-sm text-red-200">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col">
                    <label for="email" class="mb-2 font-semibold text-white">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                        placeholder="Enter your email"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-200">
                            {{ $message }}
                        </p>
                    @enderror
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

                    @error('password')
                        <p class="mt-1 text-sm text-red-200">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="flex flex-col">
                    <label for="password_confirmation" class="mb-2 font-semibold text-white">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                        placeholder="Confirm your password"
                    >
                </div>

                {{-- Register button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-[#a3b2bb] px-4 py-3 font-bold text-white transition hover:bg-[#8f9fa8] focus:outline-none focus:ring-2 focus:ring-white"
                >
                    Register
                </button>
            </form>

            <p class="mt-6 text-center text-white">
                Already have an account?
                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-yellow-300 hover:underline"
                >
                    Login
                </a>
            </p>

        </div>
    </div>
</x-layout>