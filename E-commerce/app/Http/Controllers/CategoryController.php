<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create()
    {
        return view('');
    }
    //Lo que hacemos es actualizar con la petición del usuario el producto que se ha creado
    public function add(Request $request)
    {
        //Validar form


        $category = new Category();
        $category->name = $request->name;
        $category->show=1;

       


        $category->save();

       

        return redirect()->back()->with('success', '');
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        // dd($product);
        $category->name = $request->name;
       

        $category->save();
        return redirect()->route('category.show')->with('success', '');
    }






    public function delete($id)
    {
        $category = Category::find($id);
        $category->show = !$category->show; // Cambiar el estado de visibilidad de la categoría
        $category->save();
    
        // Si la categoría se ha ocultado
        if (!$category->show) {
            // Obtener los productos asociados a esta categoría
            $products = $category->products;
    
            foreach ($products as $product) {
                // Verificar si el producto solo está asociado a esta categoría
                if ($product->categories()->count() == 1) {
                    // Ocultar el producto si no está asociado a otras categorías visibles
                    $visibleCategories = Category::where('show', true)->pluck('id');
                    $product->categories()->detach($category->id);
                    $remainingCategories = $product->categories()->whereIn('categories.id', $visibleCategories)->count();
                    if ($remainingCategories == 0) {
                        $product->show = false;
                        $product->save();
                    }
                }
            }
        } else { // Si la categoría se ha activado
            // Obtener los productos que estaban asociados a esta categoría
            $products = $category->products;
    
            foreach ($products as $product) {
                // Mostrar el producto si no estaba asociado a ninguna otra categoría visible
                if (!$product->show) {
                    $visibleCategories = Category::where('show', true)->pluck('id');
                    $remainingCategories = $product->categories()->whereIn('categories.id', $visibleCategories)->count();
                    if ($remainingCategories > 0) {
                        $product->show = true;
                        $product->save();
                    }
                }
            }
        }
    
        return redirect()->route('category.show')->with('success', 'La categoría se ha modificado correctamente.');
    }
    
    






    //Método  para listar los productos
    public function list()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function edit($id)
    {

        $category = Category::find($id);
        $product = Product::all();

        return view('Products.edit_categories', compact('category','product'));

    }
    //Metodo para mostrar los productos en la pagina principal
    public function listMain()
    {

        $category = Category::where('show', true)->paginate(3);


    }
    public function  ShowFromCategory($id)
    {
        $category = Category::find($id);

        return view('', compact('category'));
    }

    public function showProducts(Category $category)
    {
        $products = $category->products()->paginate(10); // Ajusta la paginación según tus necesidades
        return view('Products.productC', compact('products', 'category'));
    }

   
    public function activate($id)
    {
        $category = Category::findOrFail($id);
        $category->show = 1;
        $category->save();
    
        return redirect()->route('category.show')->with('success', 'La categoría se ha activado correctamente.');
    }
    


}

