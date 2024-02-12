<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

        // Antes de crear el carrito asociado al usuario que se acaba de crear es necesario guardarlo en la bbdd para que se le asigne un id.
        $newUser->save();
        $cartController->create($newUser->id);


        return $newUser;
    }


    public function update(Request $request){
        $user = Auth::user();
        if($user){

        
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
    
        $user->save();
        return redirect('/')->with('success', '');
    }else{
        return redirect()->route('login')->with('success', '');
    }
    }
    
    public function edit(){
        $user = Auth::user();
        return view("Users.UsersData", compact("user"));
    }

}
