<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('Products.createProduct');
    }
    public function update(Request $request)
    {
       $product=new Product();
       $product->name=$request->name;
       $product->description=$request->description;
       $product->price=$request->price;
       $product->stock=$request->stock;

        $product->save();
        return redirect()->route('product.list')->with('success','');
    }

    public function list()
    {
      $products=Product::all();
      return view('Products.list_product',compact('products'));

    }


}

