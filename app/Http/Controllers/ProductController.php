<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //inorder to store data in db

class ProductController extends Controller
{
    public function index(){
        return view('products.index');
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'qty' => 'required|numeric',
            'price'=>'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $newProduct = Product::create($data); // to save in db

        return redirect(route('product.index'));
    }
}
