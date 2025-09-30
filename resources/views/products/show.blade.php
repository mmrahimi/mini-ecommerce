<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            {{ $product->title }}
        </h2>
    </x-slot>

    <div
        class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="group relative h-[500px] overflow-hidden rounded-2xl">
                    <img src="{{ asset('storage/images/' . $product->image_url) }}"
                         alt="{{ $product->title }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 group-hover:brightness-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-pink-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <div class="flex flex-col justify-center space-y-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white group-hover:text-pink-500 dark:group-hover:text-purple-400 transition-colors duration-300">
                        {{ $product->title }}
                    </h1>
                    <div class="text-2xl font-semibold text-pink-500 dark:text-purple-400">
                        @money($product->price)
                    </div>
                    <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $product->description }}
                    </p>
                    <form action="{{ route('cart.products.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 rounded-lg text-base font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 shadow-lg">
                            Add to Cart
                        </button>
                    </form>

                    @can('create', [App\Models\Review::class, $product])
                        <a href="{{ route('reviews.create', $product) }}">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 rounded-lg text-base font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 shadow-lg">
                                Review this Product
                            </button>
                        </a>
                    @endcan

                    @auth
                        <form action="{{ route('wishlist.toggle', $product->slug) }}" method="post">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-pink-500 dark:text-purple-400 bg-white dark:bg-gray-900 border border-pink-200 dark:border-purple-600 hover:bg-pink-50 dark:hover:bg-purple-950 transition-all duration-300 shadow-sm w-fit">
                                @if($isFavorite)
                                    🗑️ Remove from Wishlist
                                @else
                                    ➕ Add to Wishlist
                                @endif
                            </button>
                        </form>
                    @endauth

                    @can('viewOwn', [App\Models\Review::class, $product])
                        <p class="mt-2"> You Gave This Product {{ $productRatingByUser }} Stars</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
