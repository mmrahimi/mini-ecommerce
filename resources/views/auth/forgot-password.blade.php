<x-guest-layout>
    <div class="mb-6 text-sm text-gray-300 dark:text-gray-400 animate-fade-in">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 text-sm text-pink-500 dark:text-purple-400 font-bold" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="max-w-md mx-auto p-8 bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] space-y-8">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
