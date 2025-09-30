<x-guest-layout>
    <div class="mb-6 text-sm text-gray-300 dark:text-gray-400 animate-fade-in">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-bold text-sm text-pink-500 dark:text-purple-400 animate-fade-in">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4 max-w-md mx-auto">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-pink-500 dark:text-purple-400 hover:text-pink-600 dark:hover:text-purple-500 font-bold transition-all duration-300">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
