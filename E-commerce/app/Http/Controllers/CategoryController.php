<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
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
       


        $category->save();

       

        return redirect()->back()->with('success', '');
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        // dd($product);
        $category->name = $request->name;
       

        $category->save();
        return redirect()->route('')->with('success', '');
    }






    public function delete($id)
    {

        $category = Category::find($id);
        if ($category->show) {
            $category->show = false;
        } else {
            $category->show = true;
        }

        $category->save();
        return redirect()->route('')->with('success', '');
    }






    //Método  para listar los productos
    public function list()
    {
        $categories = category::paginate(3);
        return view('admin.categories', compact('categories'));
    }

    public function edit($id)
    {

        $category = Category::find($id);
        return view('', compact('product'));
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
}

