<section>
    <header>
        <h2 class="text-xl font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm text-gray-300 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-white font-bold mb-2" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-white font-bold mb-2" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-white font-bold mb-2" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-pink-400 dark:text-purple-400" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
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
