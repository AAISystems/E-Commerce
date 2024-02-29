<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        //Validacion personalizada (solo admite letras y letras acentuadas) para el campo name del registro con Fortify
        Validator::extend('checkName', function ($attribute, $value, $parameters, $validator) {
            // Comprueba si el valor tiene al menos dos letras y solo contiene letras y espacios
            return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/', $value);
        });
        //Mensaje  personalizado llamando al campo a validar  para que no salga el mensaje de validator.checkname
        $messages = [
            'name' => 'No introducir caracteres especiales ni números. Mínimo dos caracteres',
        ];
       //Pasamos el mensaje como 
        Validator::make($input, [
            //Incluimos validacion en el array de validaciones
            'name' => ['required','checkName', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ],  $messages)->validate();
//Pasamos el mensaje como 3 argumento 
        // Pasamos por el controlador de usuarios para crear un carrito asociado.
        $userController=new UserController();
        return $userController->create($input);
    }
}
