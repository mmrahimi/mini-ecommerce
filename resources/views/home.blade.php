<x-app-layout>
    <x-slot name="header">
        @if(session()->has('success'))
            <div class="bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-200 rounded-xl max-w-2xl mx-auto px-6 py-4 mt-8 shadow-md flex items-center space-x-4 animate-fade-in-down">
                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2l4 -4M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <span class="text-lg font-medium">
            {{ session('success') }}
        </span>
            </div>
        @endif
        <div class="relative bg-gradient-to-b from-black to-gray-900 py-16 text-center overflow-hidden">
            <h2 class="text-6xl font-extrabold text-white tracking-tight uppercase animate-pulse-slow">
                {{ __('Fabric & Flair') }}
            </h2>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

            <form id="searchForm" method="GET" action="{{ route('home') }}" class="mb-12">
                <div class="relative max-w-2xl mx-auto">
                    <input
                        type="text"
                        id="searchInput"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-full py-4 px-6 rounded-xl shadow-md text-lg text-gray-900 dark:text-white bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500"
                    />
                    <button type="submit"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-pink-500 hover:text-pink-600 text-xl">
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}"
                       class="group relative bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] transition-all duration-500 hover:shadow-[0_15px_60px_rgba(0,0,0,0.2)] dark:hover:shadow-[0_15px_60px_rgba(255,255,255,0.1)]">

                        <div class="relative h-[400px] w-full overflow-hidden">
                            <img src="{{ asset('storage/images/' . $product->image_url) }}"
                                 alt="{{ $product->title }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 style="transform: perspective(1000px) rotateX(0deg) rotateY(0deg);"
                                 onmousemove="this.style.transform = `perspective(1000px) rotateX(${(event.offsetY - this.offsetHeight/2) * 0.02}deg) rotateY(${(event.offsetX - this.offsetWidth/2) * -0.02}deg)`"
                                 onmouseleave="this.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)'">

                            <div
                                class="absolute inset-0 bg-gradient-to-r from-pink-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="p-6 relative z-10">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-pink-500 dark:group-hover:text-pink-400 transition-colors duration-300 uppercase">
                                {{ $product->title }}
                            </h1>
                            <div class="text-xl font-semibold text-purple-600 dark:text-purple-400 mb-3">
                                @money($product->price)
                            </div>
                            <div class="flex items-center space-x-2 mt-2">
                                @php
                                    $rating = $ratings[$product->id];
                                    $fullStars = floor($rating);
                                    $halfStar = $rating - $fullStars >= 0.5;
                                @endphp

                                <div class="flex text-yellow-400">
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.182c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.182a1 1 0 00.95-.69l1.286-3.974z"/>
                                        </svg>
                                    @endfor

                                    @if ($halfStar)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current"
                                             viewBox="0 0 20 20">
                                            <defs>
                                                <linearGradient id="half">
                                                    <stop offset="50%" stop-color="currentColor"/>
                                                    <stop offset="50%" stop-color="transparent"/>
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#half)"
                                                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.182c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.197-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.182a1 1 0 00.95-.69l1.286-3.974z"/>
                                        </svg>
                                    @endif
                                </div>

                                <span class="text-sm text-gray-600 dark:text-gray-300">
        {{ $rating }} ({{ $reviews[$product->id] }} reviews)
    </span>
                            </div>

                        </div>

                        <div
                            class="absolute inset-0 border-4 border-transparent group-hover:border-pink-500/50 dark:group-hover:border-purple-400/50 rounded-xl transition-all duration-500"></div>
                    </a>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });
    </script>
</x-app-layout>
