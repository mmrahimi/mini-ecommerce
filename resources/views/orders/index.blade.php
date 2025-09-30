<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            Orders
        </h2>
    </x-slot>

    <div class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if($orders->count())
                <div class="space-y-8">
                    @foreach($orders as $order)
                        <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-8 transform transition-all duration-500 hover:scale-101 animate-slide-up">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-xl font-bold text-white group-hover:text-pink-500 dark:group-hover:text-purple-400 transition-colors duration-300">
                                        Order #{{ $order->id }}
                                    </h3>
                                    <p class="text-sm text-gray-400">
                                        Placed on {{ $order->created_at->format('F j, Y') }}
                                    </p>
                                </div>
                                <span class="text-base font-bold text-pink-500 dark:text-purple-400 bg-gray-800 dark:bg-gray-900 px-4 py-2 rounded-full">
                                    @money($order->total())
                                </span>
                            </div>

                            <div class="space-y-4">
                                @foreach($order->products as $product)
                                    <div class="flex justify-between items-center border-t border-pink-500/50 dark:border-purple-500/50 pt-4">
                                        <span class="text-white text-sm font-medium">{{ $product->title }}</span>
                                        <a href="{{ route('products.downloads.show', $product) }}"
                                           class="text-pink-500 dark:text-purple-400 text-sm font-bold hover:text-pink-600 dark:hover:text-purple-500 transition-all duration-300">
                                            Download
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-10 text-center text-gray-300 dark:text-gray-400 text-xl font-bold animate-fade-in">
                    You have no orders
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
