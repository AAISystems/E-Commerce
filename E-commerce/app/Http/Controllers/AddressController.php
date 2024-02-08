<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    /*Metodo para mostrar las CRUD de las direcciones
     */
    public function show()
    {

        $user = Auth::user();
        $userAddresses = $user->addresses;

        return view('userSettings.address', compact('userAddresses'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $newAddress = new Address();

        //Recojo los datos de la direccion
        $data = $request->all();
        //Elimino el _token porque no forma parte de la direccion
        unset($data['_token']);

        $completeAddress = '';

        foreach ($data as $key) {
            $completeAddress = $completeAddress.' '.$key;
        }

        $newAddress->address = $completeAddress;
        $newAddress->user_id = $user->id;
        $newAddress->save();

        $user->addresses()->save($newAddress);

        return redirect()->route('user.address')->with('success', 'Dirección añadida correctamente.');
    }
}
