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

        return redirect()->back()->with('success', 'Added to cart!');
    }
}