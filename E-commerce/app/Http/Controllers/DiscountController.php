<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{

    public function show()
    {

        $discounts = Discount::where('valid',true)->orderBy("created_at", "desc")->get();

        return view("Admin.discounts", compact("discounts"));

    }

    public function simpleDiscount()
    {

    }


    public function categoryDiscount()
    {



        $categories = Category::all();

        return view("Admin.categoryDiscount", compact("categories"));



    }

    public function productDiscount()
    {

        $products = Product::all();

        return view("Admin.productDiscount", compact("products"));
    }

    public function save(Request $request)
    {

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'exists' => 'El :attribute seleccionado no es válido.',
            'max' => [
                'string' => 'El campo :attribute no puede tener más de :max caracteres.',
            ],
        ];

        // Validación de datos con mensajes personalizados
        $validator = Validator::make($request->all(), [
            'inputCode' => 'required|string|max:255',
            'inputAmount' => 'required|numeric',
            'inputDate' => 'required|date',
            'productToAdd' => 'required|exists:products,id',
        ], $messages);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $discount = new Discount();

        $discount->code = $request->inputCode;
        $discount->amount = $request->inputAmount;


        $inputDate = Carbon::parse($request->input('inputDate'));

        if ($inputDate->isPast()) {
            return redirect()->back()->withErrors(['inputDate' => 'La fecha debe ser posterior a la fecha actual.']);
        }
        $discount->validUntil = $request->inputDate;
        $discount->valid = true;
        $discount->save();

        $product = Product::find($request->productToAdd);
        $product->discount()->associate($discount);
        $product->save();


        return redirect()->route('admin.discounts')->with('success', 'Descuento creado correctamente');

    }

    public function saveCategory(Request $request ){
        
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'exists' => 'El :attribute seleccionado no es válido.',
            'max' => [
                'string' => 'El campo :attribute no puede tener más de :max caracteres.',
            ],
        ];

        // Validación de datos con mensajes personalizados
        $validator = Validator::make($request->all(), [
            'inputCode' => 'required|string|max:255',
            'inputAmount' => 'required|numeric',
            'inputDate' => 'required|date',
            'categoryToAdd' => 'required|exists:categories,id',
        ], $messages);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $discount = new Discount();

        $discount->code = $request->inputCode;
        $discount->amount = $request->inputAmount;


        $inputDate = Carbon::parse($request->input('inputDate'));

        if ($inputDate->isPast()) {
            return redirect()->back()->withErrors(['inputDate' => 'La fecha debe ser posterior a la fecha actual.']);
        }
        $discount->validUntil = $request->inputDate;
        $discount->valid = true;
        $discount->save();

        $category = Category::find($request->categoryToAdd);
        $category->discount()->associate($discount);
        $category->save();


        return redirect()->route('discount.aplyCategory', [$category , $discount])->with('success', 'Descuento creado correctamente');

    }
    

    public function invalid($id)
    {
        $discount = Discount::find($id);

        $discount->valid = false;

        $discount->save();

        return redirect()->route('admin.discounts')->with('success', 'Descuento eliminado correctamente');
    }

    
public function applyCategoryDiscount($category, $discount)
{

    $category=Category::find ($category);
    $discount=Discount::find($discount);
    // Obtenemos todos los productos asociados a la categoría
    $products = $category->products;

    // Iteramos sobre cada producto para aplicar el descuento
    foreach ($products as $product) {

        $product->discount()->associate($discount);
        $product->save();
    }

    return redirect()->route('admin.discounts')->with('success', 'Descuento aplicado a los productos de la categoría correctamente');
}



}
