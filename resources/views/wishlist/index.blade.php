<x-app-layout>
    <x-slot name="header">
        <div class="relative bg-gradient-to-b from-black to-gray-900 py-16 text-center overflow-hidden">
            <h2 class="text-5xl font-extrabold text-white tracking-tight uppercase animate-pulse-slow">
                {{ __('My Wishlist') }}
            </h2>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @if(!$wishlistItems->count())
                <div class="text-center text-gray-700 dark:text-gray-300 text-xl">
                    Your wishlist is empty. Go find something fabulous! 💖
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($wishlistItems as $product)
                        <a href="{{ route('products.show', $product) }}"
                           class="group relative bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] transition-all duration-500 hover:shadow-[0_15px_60px_rgba(0,0,0,0.2)] dark:hover:shadow-[0_15px_60px_rgba(255,255,255,0.1)]">

                            <!-- Product Image -->
                            <div class="relative h-[400px] w-full overflow-hidden">
                                <img src="{{ asset('storage/images/' . $product->image_url) }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-pink-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6 relative z-10">
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-pink-500 dark:group-hover:text-pink-400 transition-colors duration-300 uppercase">
                                    {{ $product->title }}
                                </h1>
                                <div class="text-xl font-semibold text-purple-600 dark:text-purple-400 mb-3">
                                    @money($product->price)
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
