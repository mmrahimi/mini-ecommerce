<x-app-layout>
    <x-slot name="header">
        <div class="relative bg-gradient-to-b from-black to-gray-900 py-16 text-center overflow-hidden">
            <h2 class="text-6xl font-extrabold text-white tracking-tight uppercase animate-pulse-slow">
                {{ __('Notifications') }}
            </h2>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.05)_0%,transparent_70%)]"></div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @forelse ($notifications as $notification)
                <div class="bg-white dark:bg-gray-900 shadow-[0_10px_30px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_30px_rgba(255,255,255,0.05)] rounded-xl p-6 transition hover:shadow-lg border border-transparent hover:border-pink-400/40 dark:hover:border-purple-400/40">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-pink-500 dark:group-hover:text-pink-400 transition-colors duration-300">
                        {{ $notification->data['subject'] }}
                    </h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                        {{ $notification->data['message'] }}
                    </p>
                    <span class="text-sm text-gray-500 dark:text-gray-400 block mt-4">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            @empty
                <div class="text-center text-gray-600 dark:text-gray-300 text-xl">
                    {{ __('No notifications yet.') }}
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
