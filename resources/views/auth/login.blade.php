<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 text-sm text-pink-500 dark:text-purple-400 font-bold" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto p-8 bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] space-y-8">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Password')" class="text-white font-bold mb-2" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-pink-500/50 dark:border-purple-500/50 text-pink-500 dark:text-purple-500 focus:ring-pink-500 dark:focus:ring-purple-500 shadow-sm" name="remember">
                <span class="ms-2 text-sm text-gray-300 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-6 gap-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-pink-500 dark:text-purple-400 hover:text-pink-600 dark:hover:text-purple-500 font-bold transition-all duration-300" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
