<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    @if (Auth::user() != null)
                    <x-nav-link :href="route('reservation.all')" :active="request()->routeIs('reservation.all')">
                        {{ __('Reserveringen') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Account Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Auth::user() != null)
                    @if (Auth::user()->isAdmin)
                        <x-nav-link class="mr-4" :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')">
                            {{ __('Evenementen') }}
                        </x-nav-link>
                        <x-nav-link class="mr-4" :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Gebruikers') }}
                        </x-nav-link>
                        <x-nav-link class="mr-4" :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.index')">
                            {{ __('Reserveringen') }}
                        </x-nav-link>
                        <x-nav-link class="mr-4" :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    @endif
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Auth::user()->isAdmin)
                                <i class="fa-regular fa-user" style="color: #ffffff;"></i>
                            @endif  
                            <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div> 
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <i class="fa-solid fa-right-to-bracket p-2" style="color: #ffffff;"></i>
                                <div>Account</div> 
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('login')">
                                {{ __('Login') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fa-solid fa-house mr-2"></i>
                {{ __('Home') }}
            </x-responsive-nav-link>
            @if (Auth::user() != null)
            <x-responsive-nav-link :href="route('reservation.all')" :active="request()->routeIs('reservation.all')">
                {{ __('Reserveringen') }}
            </x-responsive-nav-link>
                @if (Auth::user()->isAdmin)
                <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')">
                    <i class="fa-solid fa-house mr-2"></i>
                    {{ __('Evenementen') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    <i class="fa-solid fa-house mr-2"></i>
                    {{ __('Gebruikers') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.index')">
                    <i class="fa-solid fa-house mr-2"></i>
                    {{ __('Reserveringen') }}
                </x-responsive-nav-link>
                @endif
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pb-1 border-t border-gray-200 dark:border-gray-600">
            @if (Auth::user() != null)
                @if (Auth::user()->isAdmin)
                    <x-responsive-nav-link :href="route('admin.index')">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endif
                <div class="mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endif
        </div>
    </div>
</nav>