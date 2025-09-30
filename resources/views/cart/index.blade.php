<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            Cart
        </h2>
    </x-slot>

    <div class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-10">
                @if(optional(optional($cart)->products)->count())
                    <div class="space-y-8">
                        @foreach($cart->products as $product)
                            <div class="flex justify-between items-center border-b border-pink-500/50 dark:border-purple-500/50 pb-6 group">
                                <div class="flex items-center gap-6">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/images/' . $product->image_url) }}"
                                             alt="{{ $product->title }}"
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white group-hover:text-pink-500 dark:group-hover:text-purple-400 transition-colors duration-300">
                                            {{ $product->title }}
                                        </h3>
                                        <p class="text-base text-gray-400 mt-1">@money($product->price)</p>
                                    </div>
                                </div>
                                <form action="{{ route('cart.products.destroy', $product) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-pink-400 dark:text-purple-400 hover:text-pink-500 dark:hover:text-purple-500 text-sm font-bold transition-all duration-300">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        @endforeach

                        <div class="pt-8 border-t border-pink-500/50 dark:border-purple-500/50">
                            <div class="flex justify-between items-center text-2xl font-bold text-white">
                                <span>Total</span>
                                <span class="text-pink-500 dark:text-purple-400">@money($cart->total())</span>
                            </div>

                            <div class="mt-8 text-center">
                                <form action="{{ route('checkout.index') }}" method="POST">
                                    <input type="hidden" name="total" value="{{ $cart->total() }}">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-8 py-4 rounded-lg text-base font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 shadow-lg animate-subtle-bounce">
                                        Proceed to Checkout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-300 dark:text-gray-400 py-16 text-xl font-bold animate-fade-in">
                        Your cart is empty
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
