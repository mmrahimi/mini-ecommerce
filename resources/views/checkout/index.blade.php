<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent tracking-tight animate-fade-in">
            Payment
        </h2>
    </x-slot>

    <div class="py-20 bg-gradient-to-b from-gray-100 to-gray-200 dark:from-gray-950 dark:to-black min-h-screen relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.1)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.1)_0%,transparent_70%)] opacity-30"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-950 dark:to-black rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] dark:shadow-[0_10px_40px_rgba(255,255,255,0.05)] p-8">
                <form action="{{ route('fakepay') }}" method="post" class="max-w-lg mx-auto p-8 rounded-lg space-y-8">
                    @if (session('error'))
                        <div class="px-4 py-3 rounded-lg bg-pink-500/20 dark:bg-purple-500/20 text-pink-400 dark:text-purple-400 text-sm font-bold animate-fade-in">
                            {{ session('error') }}
                        </div>
                    @endif

                    @csrf
                    <div>
                        <label class="block text-white font-bold mb-3">Card Number:</label>
                        <input type="text" name="card_number" required
                               class="w-full px-5 py-3 rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm shadow-sm hover:bg-gray-700" />
                        @error('card_number')
                        <p class="text-pink-400 dark:text-purple-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-white font-bold mb-3">CVV:</label>
                        <input type="text" name="cvv" required
                               class="w-full px-5 py-3 rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm shadow-sm hover:bg-gray-700" />
                        @error('cvv')
                        <p class="text-pink-400 dark:text-purple-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                        <div>
                            <img src="{{ captcha_src() }}" alt="captcha" id="captcha-img">
                            <button type="button" onclick="document.getElementById('captcha-img').src='{{ captcha_src() }}?r=' + Math.random();">🔄</button>
                            <script>
                                function refreshCaptcha() {
                                    const img = document.getElementById('captcha-img');
                                    img.src = '{{ route('captcha') }}?r=' + Math.random();
                                }
                            </script>
                            <label class="block text-white font-bold mb-3">Captcha Code:</label>
                            <input type="text" name="captcha" required
                                   class="w-full px-5 py-3 rounded-lg border border-pink-500/50 dark:border-purple-500/50 bg-gray-800 dark:bg-gray-900 text-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 text-sm shadow-sm hover:bg-gray-700" />
                            @error('captcha')
                            <p class="text-pink-400 dark:text-purple-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    <div class="text-lg font-bold text-white">
                        Total Price: <span class="text-pink-500 dark:text-purple-400">@money($cart->total())</span>
                    </div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg animate-subtle-bounce">
                        Pay Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
