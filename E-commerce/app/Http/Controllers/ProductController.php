<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// Vamos a necesitar estos 3 primeros métodos, para trabajar con los productos, en este caso se realizan el método crear primero para añadir un nuevo producto
// creado por el administrador, para posteriormente usar el método update para actualizar el producto, y poder listarlo, por ello hemos utilizado estos 3 métodos.
class ProductController extends Controller
{
    public function create()
    {
        return view('Products.createProduct');
    }
    //Lo que hacemos es actualizar con la petición del usuario el producto que se ha creado
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

    //Método  para listar los productos
    public function list()
    {
      $products=Product::all();
      return view('Products.list_product',compact('products'));

    }


}

