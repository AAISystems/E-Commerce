<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //home
    public function mostrarAdmin()
    {
        return view('Admin.admin');
    }

    //list

    public function list()
    {
      $categories=Category::all();
      $products=Product::paginate(3);
      return view('Admin.listp',compact('products','categories'));

    }
}
