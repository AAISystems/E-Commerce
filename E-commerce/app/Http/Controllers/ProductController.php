<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
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


        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;


        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);

                $product->images()->create([
                    'route' => 'images/' . $imageName,
                    'product_id' => $product->id
                ]);
            }
        }

        return redirect()->route('admin.listp')->with('success', '');
    }
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        
       
        $product->save();
    
        // Actualizar las categorías asociadas al producto
        if ($request->has('categories')) {
           
            $product->categories()->attach($request->categories);
        } else {
            // Si no se seleccionaron categorías, desasociar todas las categorías del producto
            $product->categories()->detach();
        }
    
        // Verificar si todas las categorías asociadas al producto están ocultas
        $hiddenCategories = $product->categories()->where('show', false)->count();
        if ($hiddenCategories == $product->categories()->count()) {
            $product->show = false;
            $product->save();
        } else {
            $product->show = true;
            $product->save();
        }
    
        return redirect()->route('admin.listp')->with('success', 'El producto se ha actualizado correctamente.');
    }
    
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->show) {
            $product->show = false;
        } else {
            $product->show = true;
        }
    
        $product->save();
        return redirect()->route('admin.listp')->with('success', '');
    }





    //Método  para listar los productos
    public function list()
    {
        $products = Product::paginate(3);
        return view('Products.list_product', compact('products'));
    }

    public function edit($id)
    {

        $product = Product::find($id);
        $categories = Category::all();

        return view('Products.edit_product', compact('product','categories'));

    }
    //Metodo para mostrar los productos en la pagina principal
    public function listMain()
    {

        $products = Product::where('show', true)->paginate(3);


        // Cogemos al usuario autenticado
        $user = Auth::user();
        if ($user) {
            // Buscamos su carrito asociado
            $userCart = $user->cart;
            
            // Cogemos los productos asociados al carrito
            if ($userCart->products) {
                $productsInCart = $userCart->products;
            }



            return view('welcome', compact('products', 'productsInCart','user'));
        } else {
            return view('welcome', compact('products'));
        }
    }

    public function  showProduct($id)
    {
        $product = Product::find($id);

        return view('Products.product', compact('product'));
    }


    public function showFromCategory($id)
    {
         // Encuentra la categoría por su ID
         $category = Category::find($id);

         // Si la categoría existe
         if ($category) {
             // Recupera todos los productos asociados a esa categoría
             $products = $category->products()->where('show', true)->paginate(3);
             
             // Aquí puedes agregar lógica adicional si lo necesitas, como mostrar productos en el carrito, etc.
 
             // Retorna la vista con los productos de la categoría
             return view('Products.category_products', compact('products', 'category'));
         } else {
             // Si la categoría no existe, redirige o muestra un mensaje de error
             return redirect()->back()->with('error', 'La categoría no existe.');
         }
     }

     public function removeFromCategory(Product $product, Category $category)
     {
         // Quita el producto solo de esta categoría
         $category->products()->detach($product);
     
         // Verifica si el producto aún está asociado a otras categorías
         $remainingCategories = $product->categories()->count();
     
         // Si el producto no tiene más categorías asociadas, se oculta
         if ($remainingCategories == 0) {
             $product->show = false;
             $product->save();
         }
     
         return redirect()->back()->with('message', 'Producto quitado de la categoría exitosamente');
     }

     
     
     
 }







