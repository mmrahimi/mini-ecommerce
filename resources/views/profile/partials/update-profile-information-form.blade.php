<section>
    <header>
        <h2 class="text-xl font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-300 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white font-bold mb-2" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-pink-400 dark:text-purple-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white font-bold mb-2" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-pink-400 dark:text-purple-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-3 text-gray-300 dark:text-gray-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="text-sm text-pink-500 dark:text-purple-400 hover:text-pink-600 dark:hover:text-purple-500 font-bold transition-all duration-300">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-pink-500 dark:text-purple-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-pink-500 dark:text-purple-400 font-bold"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
