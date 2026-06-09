<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <!-- HEADER -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">

                @auth
                    <h1>Welcome customer!</h1>
                    <x-dropdown align="right" width="48">
                        
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border rounded-md text-sm text-gray-600 bg-white hover:text-gray-800">
                                <div>{{ Auth::user()->name }}</div>

                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <!-- Profile -->
                            <x-dropdown-link :href="route('profile.guest')">
                                Profile
                            </x-dropdown-link>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>

                @else
                    <a href="{{ route('login') }}" class="px-5 py-1.5 border rounded-sm">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-1.5 border rounded-sm">Register</a>
                    @endif
                @endauth

            </nav>
        @endif
    </header>

    <!-- MAIN CONTENT -->
    <div class="w-full lg:max-w-4xl max-w-[335px] flex flex-col gap-6">

        <!-- PRODUCT LIST SECTION -->
        <div class="p-6 border rounded-lg bg-white shadow">
            <h2 class="text-lg font-semibold mb-4">Product List</h2>

            <div class="space-y-3">
                <!-- Example product item -->
                <div class="p-3 border rounded flex justify-between">
                    <span>Product 1</span>
                    <span>$10</span>
                </div>

                <div class="p-3 border rounded flex justify-between">
                    <span>Product 2</span>
                    <span>$20</span>
                </div>

                <div class="p-3 border rounded flex justify-between">
                    <span>Product 3</span>
                    <span>$30</span>
                </div>
            </div>
        </div>

        <!-- CUSTOMER SECTION -->
        <div class="p-6 border rounded-lg bg-white shadow">
            <h2 class="text-lg font-semibold mb-4">Customers</h2>

            <div class="space-y-3">
                
            </div>
        </div>

    </div>

</body>
</html>