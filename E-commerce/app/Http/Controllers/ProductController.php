<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Vamos a necesitar estos 3 primeros métodos, para trabajar con los productos, en este caso se realizan el método crear primero para añadir un nuevo producto
// creado por el administrador, para posteriormente usar el método update para actualizar el producto, y poder listarlo, por ello hemos utilizado estos 3 métodos.
class ProductController extends Controller
{
    public function create()
    {
        return view('Products.createProduct');
    }
    //Lo que hacemos es actualizar con la petición del usuario el producto que se ha creado
    public function add(Request $request)
    {
        //Validar form


       $product=new Product();
       $product->name=$request->name;
       $product->description=$request->description;
       $product->price=$request->price;
       $product->stock=$request->stock;


        $product->save();
       
 // Procesar imágenes
 if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        Image::create([
            'url' => 'storage/' . str_replace('public/', '', $file->store('public/img')),
            'product_id' => $product->id
        ]);
    }
}

        return redirect()->route('admin.listp')->with('success','');
    }



    public function update(Request $request){
        $product=Product::find($request->id);
        // dd($product);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->stock=$request->stock;
      
        $product->save();
        return redirect()->route('admin.listp')->with('success','');
    }

   

  


    public function delete($id){

        $product=Product::find($id);
        if($product->show){
        $product->show=false;
        }else{
            $product->show=true;
        }
        
        $product->save();
        return redirect()->route('admin.listp')->with('success','');

    }






    //Método  para listar los productos
    public function list()
    {
      $products=Product::paginate(3);
      return view('Products.list_product',compact('products'));

    }

    public function edit($id)
    {

        $product=Product::find($id);
        return view('Products.edit_product',compact('product'));
    }
     //Metodo para mostrar los productos en la pagina principal
     public function listMain()
     {
 
         $products = Product::paginate(3);
 
 
         // Cogemos al usuario autenticado
         $user = Auth::user();
         if ($user) {
             // Buscamos su carrito asociado
             $userCart = Cart::where('users_id', $user->id)->first();
 
             // Cogemos los productos asociados al carrito
             $productsInCart = $userCart->products;
 
 
             return view('welcome', compact('products', 'productsInCart'));
         }else{
             return view('welcome', compact('products'));
         }
     }

     public function  showProduct($id){
        $product=Product::find($id);

        return view('Products.product',compact('product'));
     }




}

