<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
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
}