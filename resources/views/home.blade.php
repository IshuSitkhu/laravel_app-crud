<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>

    @include('layouts.navigation')

  <div class="w-full lg:max-w-4xl max-w-[335px] mx-auto flex flex-col gap-6 text-[#1b1b18] p-6 lg:p-8">

        <div class="p-6 border rounded-lg bg-white shadow">
            <h2 class="text-lg font-semibold mb-6">Product List</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">

                <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition bg-white">

                    <div class="w-full aspect-square overflow-hidden">
                        <img src="{{ asset('images/products/product2.jpg') }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-4 space-y-2">

                        <h3 class="font-semibold text-lg">Product 1</h3>

                        <p class="text-sm text-gray-500">
                            Seller: John Doe
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-bold">Rs.1,50,000</span>

                            <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-700">
                                In Stock
                            </span>
                        </div>

                        <div class="flex gap-2 pt-2">
                            <button class="flex-1 bg-blue-600 text-white text-sm py-2 rounded hover:bg-blue-700">
                                Add to Cart
                            </button>

                            <button class="flex-1 bg-black text-white text-sm py-2 rounded hover:bg-gray-800">
                                Buy Now
                            </button>
                        </div>

                    </div>
                </div>

                <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition bg-white">
                    <div class="w-full aspect-square overflow-hidden">
                        <img src="{{ asset('images/products/product1.jpg') }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-4 space-y-2">
                        <h3 class="font-semibold text-lg">Product 2</h3>
                        <p class="text-sm text-gray-500">Seller: Jane Smith</p>

                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-bold">Rs.3,00,000</span>
                            <span class="text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-700">
                                Low Stock
                            </span>
                        </div>

                        <div class="flex gap-2 pt-2">
                            <button class="flex-1 bg-blue-600 text-white text-sm py-2 rounded hover:bg-blue-700">
                                Add to Cart
                            </button>

                            <button class="flex-1 bg-black text-white text-sm py-2 rounded hover:bg-gray-800">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>

                @foreach($products as $product)
                    <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition bg-white">

                        <div class="w-full aspect-square overflow-hidden">

                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover">

                        </div>

                        <div class="p-4 space-y-2">

                            <h3 class="font-semibold text-lg">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Seller: {{ $product->user->name ?? 'Unknown' }}
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-green-600 font-bold">
                                    Rs.{{ $product->price }}
                                </span>

                                <span class="text-xs px-2 py-1 rounded
                                    {{ $product->status == 'in_stock' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                                    {{ $product->status == 'in_stock' ? 'In Stock' : 'Out of Stock' }}

                                </span>
                            </div>
                            <div class="flex gap-3 pt-3">

                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                    @csrf

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white text-sm font-medium py-2.5 px-4 rounded-lg
                                            hover:bg-blue-700 transition duration-200">
                                        Add to Cart
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('cart.buynow', $product->id) }}" class="flex-1">
                                    @csrf

                                    <button type="submit"
                                        class="w-full bg-black text-white text-sm font-medium py-2.5 px-4 rounded-lg
                                            hover:bg-gray-800 transition duration-200">
                                        Buy Now
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="p-6 border rounded-lg bg-white shadow">
            <h2 class="text-lg font-semibold mb-4">Customers</h2>

            <div class="space-y-3">
                
            </div>
        </div>

    </div>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
        timer: 2500,
        showConfirmButton: false
    });
</script>
@endif

</body>
</html>