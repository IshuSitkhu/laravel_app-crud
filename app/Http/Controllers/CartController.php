<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        //get user
        $user = auth()->user();

        //  if cart exists (use it)  if not(create new cart)
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        //  Check if product already in cart
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            // increase quantity
            $item->qty += 1;
            $item->save();
        } else {
            // create new item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart!');

    }

    public function index()
    {
        $user = auth()->user();

        // get cart with items + product details
        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->first();

        return view('cart.index', compact('cart'));
    }

    public function increase(CartItem $item)
    {
        $item->qty += 1;
        $item->save();

        return redirect()->back();
    }

   public function decrease(CartItem $item)
    {
        if ($item->qty > 1) {
            $item->qty -= 1;
            $item->save();
        } else {
            $item->delete(); // remove item if qty = 0
        }

        return redirect()->back();
    }

    public function checkout()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // 1. Calculate total
        $total = 0;

        foreach ($cart->items as $item) {
            $total += $item->qty * $item->product->price;
        }

        // 2. Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'status' => 'pending'
        ]);

        // 3. Move cart items → order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->product->price
            ]);
        }

        // 4. Clear cart
        $cart->items()->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Order placed successfully!');
    }



    public function buyNow(Product $product)
    {
        $user = auth()->user();

        // 1. Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $product->price,
            'status' => 'pending'
        ]);

        // 2. Create single order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'qty' => 1,
            'price' => $product->price
        ]);

        return redirect()->back()
            ->with('success', 'Order placed successfully (Buy Now)!');
    }
}