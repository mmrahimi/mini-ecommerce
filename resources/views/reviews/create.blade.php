<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-6 mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 uppercase">
                        {{ $product->title }}
                    </h1>
                    <div class="text-xl font-semibold text-purple-600 dark:text-purple-400 mb-3">
                        ${{ $product->price }}
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <form id="reviewForm" method="POST" action="{{ route('reviews.store', $product) }}" class="bg-white dark:bg-gray-900 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-8 transition-all duration-500 hover:shadow-[0_15px_60px_rgba(0,0,0,0.2)] dark:hover:shadow-[0_15px_60px_rgba(255,255,255,0.1)]">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-900 dark:text-white mb-3">
                            Your Rating
                        </label>
                        <div class="flex justify-center space-x-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden peer">
                                <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 dark:text-gray-600 transition-colors duration-300">
                                    ★
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button
                            type="submit"
                            class="relative inline-block px-8 py-3 text-lg font-semibold text-white bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg shadow-md hover:from-pink-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950 transition-all duration-300 group"
                        >
                            Submit Review
                            <span class="absolute inset-0 bg-gradient-to-r from-pink-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-lg"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function (e) {
            const rating = document.querySelector('input[name="rating"]:checked');
            if (!rating) {
                e.preventDefault();
                alert('Please select a rating.');
            }
        });

        document.querySelectorAll('input[name="rating"]').forEach((input) => {
            input.addEventListener('change', function () {
                const rating = parseInt(this.value);
                document.querySelectorAll('label[for^="star"]').forEach((label, index) => {
                    if (index < rating) {
                        label.classList.add('text-yellow-400');
                        label.classList.remove('text-gray-300', 'dark:text-gray-600');
                    } else {
                        label.classList.remove('text-yellow-400');
                        label.classList.add('text-gray-300', 'dark:text-gray-600');
                    }
                });
            });
        });
    </script>
</x-app-layout>
