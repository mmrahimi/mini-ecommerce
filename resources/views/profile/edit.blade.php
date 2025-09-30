<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            <div class="p-6 sm:p-10 bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] rounded-3xl animate-slide-up">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] rounded-3xl animate-slide-up">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] rounded-3xl animate-slide-up">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
