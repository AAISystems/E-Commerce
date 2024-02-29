<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use App\Models\Cart;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Crear un usuario.
    public function create(array $input)
    {
        $newUser = new User();
        $newUser->name = $input['name'];
        $newUser->email = $input['email'];
        $newUser->password = Hash::make($input['password']);
        // $newUser->roles_id=1;

        // Creamos un carrito asociado al usuario por el ID.
        $cartController = new CartController();
        //Cuando el usuario se registar a parte del carrito tambien se le crea la wishlist
        $wishlistController = new WishlistController();


        // Antes de crear el carrito asociado al usuario que se acaba de crear es necesario guardarlo en la bbdd para que se le asigne un id.

        $newUser->save();

        //Cuando se ha guardado el nuevo usuario en la bbdd se crean carrito y wishlist asociados al id de ese uduario
        //Si ponemos estas instrucciones antes de gauradr el usuario, se crearian estos elementos asodicados a un id que no existe

        $cartController->create($newUser->id);
        $wishlistController->create($newUser->id);


        return $newUser;
    }


    public function update(Request $request)
    {
        // Realiza la validación de los campos
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'min:2', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|edu|gov)$/i'],
            'phone' => ['nullable', 'numeric', 'digits_between:9,9', 'not_regex:/[a-zA-Z]/', 'min:0'],
        ], [
            'name.min' => 'El nombre debe tener mínimo :min letras.',
            'name.regex' => 'El nombre no puede contener números ni caracteres especiales.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.ends_with' => 'El email debe terminar en ".com, .net, .org, .edu, .gov".',
            'phone.numeric' => 'El teléfono debe ser un número.',
            'phone.digits_between' => 'El teléfono debe tener exactamente :min dígitos.',
            'phone.not_regex' => 'El teléfono no puede contener letras ni caracteres especiales.',
            'phone.min' => 'El teléfono no puede ser negativo.',
        ]);
    
        // Si la validación falla, redireccionar con los errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = Auth::user();
        if ($user) {
            // Verificar si el usuario ha actualizado algún campo
            if ($request->filled('name') || $request->filled('email') || $request->filled('phone')) {
                //Usamos try cath para manejar la excepción de que de la casualidad que el usuario introduzca un correo o tlf q ya exista
                try {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    
                    $user->save();
                    return redirect('/')->with('success', 'Usuario actualizado exitosamente');
                } catch (QueryException $exception) {
                    //Si introduce email o tlfn existente le salta el mensaje de error
                    if ($exception->errorInfo[1] === 1062) {
         
                        throw ValidationException::withMessages(['email' => 'El correo electrónico  ya está en uso', 'phone'=>'El número de teléfono ya está en uso']);
                    } else {
                        // Manejar otros errores de la base de datos
                        // Por ejemplo, podrías registrar el error o redirigir a una página de error general
                        return redirect()->route('error')->with('error', 'Error en la base de datos');
                    }
                }
            } else {
                // Si el usuario no ha realizado cambios, redirigir a la página principal
                return redirect('/')->with('info', 'No se han realizado cambios');
            }
        } else {
            return redirect()->route('login')->with('success', '');
        }
    }
    
    public function edit()
    {
        $user = Auth::user();
        $categories = Category::where('show', true)->get();

        return view("Users.UsersData", compact("user",'categories'));
    }
    
    public function seeData(){
        $user=Auth::user();
        $categories = Category::where('show', true)->get();
        return view("Users.userViewData", compact('user','categories'));
    }


}
