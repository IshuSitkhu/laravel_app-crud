<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">
                    Your Cart
                </h2>

                @if($cart && $cart->items->count())
                    
                    @foreach($cart->items as $item)
                        <div class="border-b py-4 flex justify-between items-center">

                            <div>
                                <h3 class="text-lg font-semibold">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Price: Rs {{ $item->product->price }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Quantity: {{ $item->qty }}
                                </p>
                                <div class="flex gap-6">
                                    <form method="POST" action="{{ route('cart.increase', $item->id) }}">
                                    @csrf
                                    <button class="px-2 py-1 bg-gray-300 rounded">
                                        +
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('cart.decrease', $item->id) }}">
                                    @csrf
                                    <button class="px-2 py-1 bg-gray-300 rounded">
                                        -
                                    </button>
                                </form>
                                </div>
                                
                            </div>

                            <div class="text-right">
                                <p class="font-semibold text-gray-800">
                                    Rs {{ $item->qty * $item->product->price }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                    @php $total = 0; @endphp

                    @foreach($cart->items as $item)
                        @php
                            $total += $item->qty * $item->product->price;
                        @endphp
                    @endforeach

                    <div class="mt-6 text-right">
                        <h3 class="text-xl font-bold">
                            Total: Rs {{ $total }}
                        </h3>

                        
                    </div>
                    <form method="POST" action="{{route('cart.checkout')}}">
                        @csrf

                        <button class="flex-1 bg-blue-600 w-full text-white text-sm py-2 rounded hover:bg-blue-700">
                                    Proceed to Checkout
                        </button>
                    </form>
                    

                @else
                    <p class="text-gray-500">
                        Your cart is empty
                    </p>
                @endif

                <!-- <div class="mt-6">
                    <a href="{{ url('/') }}"
                       class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Back to Home
                    </a>
                </div> -->

            </div>
        </div>
    </div>
</x-app-layout>