<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            Admin – Product Management
        </h2>
    </x-slot>

    <div
        class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-8 flex justify-end">
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center px-8 py-3 rounded-lg text-base font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 shadow-lg animate-subtle-bounce">
                    Add Product
                </a>
            </div>

            <div
                class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] rounded-3xl p-8">
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            <div
                                class="bg-gray-800 dark:bg-gray-900 rounded-2xl shadow-lg p-6 flex flex-col transform transition-all duration-500 hover:scale-105 hover:shadow-[0_15px_60px_rgba(236,72,153,0.2)] dark:hover:shadow-[0_15px_60px_rgba(168,85,247,0.2)] animate-slide-up">
                                <div class="relative h-48 w-full overflow-hidden rounded-lg mb-4">
                                    <img src="{{ asset('storage/images/' . $product->image_url) }}"
                                         alt="{{ $product->title }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-pink-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                </div>

                                <h3 class="text-lg font-bold text-white mb-4 group-hover:text-pink-500 dark:group-hover:text-purple-400 transition-colors duration-300">
                                    {{ $product->title }}
                                </h3>

                                <div class="mt-auto flex justify-between space-x-4">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="flex-1 text-center bg-pink-500 dark:bg-purple-500 hover:bg-pink-600 dark:hover:bg-purple-600 text-white text-sm font-bold px-4 py-2 rounded-lg transition-all duration-300">
                                        Update
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 bg-red-500 hover:bg-red-600 text-white text-sm font-bold px-4 py-2 rounded-lg transition-all duration-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-300 dark:text-gray-400 py-24 text-xl font-bold animate-fade-in">
                        No products found.
                    </div>
                @endif
            </div>
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
