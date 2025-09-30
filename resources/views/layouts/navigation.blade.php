<nav x-data="{ open: false }"
     class="bg-gradient-to-r from-gray-900 to-black dark:bg-gradient-to-r dark:from-gray-950 dark:to-black border-b border-pink-500/50 dark:border-purple-500/50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo
                            class="block h-9 w-auto fill-current text-pink-500 dark:text-purple-400 transition-colors duration-300 hover:text-pink-400 dark:hover:text-purple-300"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @can('manage', App\Models\Product::class)
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')"
                                    class="text-white hover:text-pink-500 dark:hover:text-purple-400 font-bold tracking-wide transition-colors duration-300 border-b-2 border-transparent hover:border-pink-500 dark:hover:border-purple-400">
                            Admin Panel
                        </x-nav-link>
                    @endcan
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                                class="text-white hover:text-pink-500 dark:hover:text-purple-400 font-bold tracking-wide transition-colors duration-300 border-b-2 border-transparent hover:border-pink-500 dark:hover:border-purple-400">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')"
                                class="text-white hover:text-pink-500 dark:hover:text-purple-400 font-bold tracking-wide transition-colors duration-300 border-b-2 border-transparent hover:border-pink-500 dark:hover:border-purple-400">
                        Cart ({{ optional(optional($cart)->products)->count() ?? 0 }})
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-pink-500/50 dark:border-purple-500/50 text-sm font-bold rounded-lg text-white bg-gradient-to-r from-pink-500/20 to-purple-500/20 hover:from-pink-500/30 hover:to-purple-500/30 focus:outline-none transition-all duration-300">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')"
                                             class="text-gray-900 dark:text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 transition-colors duration-300">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('notifications.index')"
                               class="relative flex items-center gap-2 px-4 py-2 rounded-md
          text-gray-900 dark:text-white
          hover:bg-pink-500/20 dark:hover:bg-purple-500/20
          transition-colors duration-300">

                                <span>Notifications</span>

                                @php
                                    $unreadNotificationsCount = auth()->user()->notifications()->unread()->count();
                                @endphp

                                @if($unreadNotificationsCount > 0)
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full
                     bg-red-600 text-white text-xs font-bold shadow-md
                     ring-2 ring-white dark:ring-gray-900">
            {{ $unreadNotificationsCount }}
        </span>
                                @endif
                            </x-dropdown-link>

                                <x-dropdown-link :href="route('wishlist.show')"
                                                 class="text-gray-900 dark:text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 transition-colors duration-300">
                                    Wishlist
                                </x-dropdown-link>

                            <x-dropdown-link :href="route('orders.index')"
                                             class="text-gray-900 dark:text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 transition-colors duration-300">
                                Orders
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();"
                                                 class="text-gray-900 dark:text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 transition-colors duration-300">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                           class="text-sm text-white hover:text-pink-500 dark:hover:text-purple-400 font-bold transition-colors duration-300">Log
                            in</a>
                        <a href="{{ route('register') }}"
                           class="text-sm text-pink-500 dark:text-purple-400 hover:text-pink-400 dark:hover:text-purple-300 font-bold transition-colors duration-300">Sign
                            up</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-lg text-pink-500 dark:text-purple-400 hover:text-pink-400 dark:hover:text-purple-300 hover:bg-pink-500/20 dark:hover:bg-purple-500/20 focus:outline-none focus:bg-pink-500/20 dark:focus:bg-purple-500/20 focus:text-pink-400 dark:focus:text-purple-300 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
         class="hidden sm:hidden bg-gradient-to-r from-gray-900 to-black dark:from-gray-950 dark:to-black border-t border-pink-500/50 dark:border-purple-500/50">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                                       class="text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 hover:text-pink-500 dark:hover:text-purple-400 font-bold transition-all duration-300">
                    {{ __('Products') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-pink-500/50 dark:border-purple-500/50">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                                           class="text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 hover:text-pink-500 dark:hover:text-purple-400 font-bold transition-all duration-300">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();"
                                               class="text-white hover:bg-pink-500/20 dark:hover:bg-purple-500/20 hover:text-pink-500 dark:hover:text-purple-400 font-bold transition-all duration-300">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
