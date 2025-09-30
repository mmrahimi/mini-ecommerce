<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            Edit Product – {{ $product->title }}
        </h2>
    </x-slot>

    <div class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-3xl mx-auto px-6 relative z-10">
            <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl p-12 space-y-8 shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)]">
                <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <div>
                            <label for="title" class="block text-sm font-bold text-white mb-2">
                                Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ $product->title }}"
                                   class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">
                            @error('title')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-bold text-white mb-2">
                                Slug
                            </label>
                            <input type="text" name="slug" id="slug" value="{{ $product->slug }}"
                                   class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">
                            @error('slug')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-white mb-2">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-bold text-white mb-2">
                                Price ($)
                            </label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}"
                                   class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">
                            @error('price')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-bold text-white mb-2">
                                Image
                            </label>
                            <input type="file" name="image" id="image"
                                   class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">
                            @error('image')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="file_path" class="block text-sm font-bold text-white mb-2">
                                File Attachment
                            </label>
                            <input type="file" name="file_path" id="file_path"
                                   class="w-full rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm px-5 py-3 shadow-sm hover:bg-gray-700">
                            @error('file_path')
                            <p class="mt-2 text-sm text-pink-400 dark:text-purple-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-8">
                        <a href="{{ route('admin.index') }}"
                           class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-bold text-white border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 hover:bg-gray-700 transition-all duration-300 shadow-sm">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-bold text-white bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 shadow-lg">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
