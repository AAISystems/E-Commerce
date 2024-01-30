<?php

namespace App\Http\Controllers;
//HAY QUE IMPORTARL EL MODELO PARA QUE FUNCIONE
use App\Models\Role;

use Illuminate\Http\Request;


//Creo el controlador de role
class RoleController extends Controller
{

    //Creo una funcion para asignar un rol admin
    public function createAdminRole()
    {
        //Primero buscar si ese rol ya existe, si es asi no tendri sentido crearlo
        $adminRole = Role::where('rol', 'admin')->first();

        // En caso de que no exista el rol se crea accediento a la columna role y dandole un valor asignado a un id
        if (!$adminRole) {
            $newRole = new Role();
            $newRole->rol = 'admin';
            $newRole->save();

           
        }

       
    }
}
