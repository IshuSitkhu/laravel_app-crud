<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //inorder to store data in db

class ProductController extends Controller
{
    public function index(){
    // $products = Product::all();    // inorder to show data in index page
     $products = Product::with('user')->get();
    return view('products.index' , ['products' => $products]);
        
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'qty' => 'required|numeric',
            'price'=>'required|decimal:0,2',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        if (!auth()->check()) {
            abort(403, 'You must be logged in');
        }
        // dd(auth()->user(), auth()->id());

        $data['user_id'] = auth()->id(); //GET LOGGEDIN USERID SO THAT USERID=1 HUNXA

        $data['status'] = ($request->qty > 0) ? 'in_stock' : 'out_of_stock';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        
       Product::create($data); // INSERT DATA AND save in db

        return redirect()->route('product.index')
    ->with('success', 'Product created successfully');
    }

    public function edit(Product $product){
        return view ('products.edit', ['product' => $product]);
    }

    public function update (Product $product, Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'qty' => 'required|numeric',
            'price'=>'required|decimal:0,2',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $data['status'] = ($request->qty > 0) ? 'in_stock' : 'out_of_stock';

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

        $product->update($data);

        return redirect(route('product.index')) ->with('success', 'Product Updated succesfully');
    }

    public function destroy(Product $product){
        $product->delete();

        return redirect(route('product.index')) ->with('success', 'Product deleted succesfully');

    }
}
