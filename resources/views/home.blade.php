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

<body>

    <!-- HEADER -->
    @include('layouts.navigation')

    <!-- MAIN CONTENT -->
  <div class="w-full lg:max-w-4xl max-w-[335px] mx-auto flex flex-col gap-6 text-[#1b1b18] p-6 lg:p-8">

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