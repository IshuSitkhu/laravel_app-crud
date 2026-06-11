<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex items-center space-x-6">

                <!-- Logo -->
                
                    <x-application-logo class="h-9 w-auto text-gray-800" />
                

                <!-- NAV LINKS -->
                <div class="hidden sm:flex space-x-6">
                    @php
                        $roleLabel = 'Guest';

                        if (auth()->check()) {
                            $role = auth()->user()->role;

                            $roleLabel = [
                                'admin' => 'Admin',
                                'seller' => 'Seller',
                                'customer' => 'Customer',
                            ][$role] ?? 'User';
                        }
                    @endphp



                <!-- <h2 class="text-lg font-semibold">
                    Welcome {{ $roleLabel }}
                </h2> -->

                    @auth
                        <!-- Home -->
                        

                        <!-- ADMIN -->
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="url('/')" :active="request()->is('admin*')">
                                Admin Dashboard
                            </x-nav-link>

                            <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')">
                                Products
                            </x-nav-link>
                        @endif

                        <!-- SELLER -->
                        @if(auth()->user()->role === 'seller')
                            <x-nav-link :href="url('/')" :active="request()->is('seller*')">
                                Seller Dashboard
                            </x-nav-link>

                            <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')">
                                Products
                            </x-nav-link>
                        @endif

                        <!-- CUSTOMER (optional future use) -->
                        @if(auth()->user()->role === 'customer')
                            <x-nav-link :href="url('/')" :active="request()->is('customer*')">
                                    Customer Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                Shop
                            </x-nav-link>
                        @endif

                        <x-nav-link :href="route('cart.index')" >
                            Cart
                        </x-nav-link>

                    @endauth

                </div>
            </div>

            <!-- RIGHT SIDE (USER MENU) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">

                @auth
                    <x-dropdown align="right" width="48">

                        <!-- TRIGGER -->
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border rounded-md text-sm text-gray-600 bg-white hover:text-gray-800">
                                <span>{{ Auth::user()->name }}</span>

                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <!-- CONTENT -->
                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>

                        </x-slot>

                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 border rounded text-sm">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 border rounded text-sm">Register</a>
                @endauth

            </div>

            <!-- MOBILE BUTTON -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-md">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden border-t">

        <div class="px-4 pt-2 pb-3 space-y-1">

            @auth

                <x-responsive-nav-link :href="route('dashboard')">
                    Home
                </x-responsive-nav-link>

                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="url('/admin/dashboard')">
                        Admin Dashboard
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('product.index')">
                        Products
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->role === 'seller')
                    <x-responsive-nav-link :href="url('/seller/dashboard')">
                        Seller Dashboard
                    </x-responsive-nav-link>
                @endif

            @endauth

        </div>

        <!-- MOBILE PROFILE -->
        <div class="pt-4 pb-3 border-t">

            @auth
                <div class="px-4">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">

                    <x-responsive-nav-link :href="route('profile.edit')">
                        Profile
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>

                </div>
            @endauth

        </div>
    </div>

</nav>