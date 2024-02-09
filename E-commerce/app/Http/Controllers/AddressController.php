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


        foreach ($data as $key => $value) {
            $completeAddress = $completeAddress . ' ' . $value;
            $newAddress->$key = $value;
        }


        $newAddress->dataAddress = $completeAddress;
        $newAddress->user_id = $user->id;
        $newAddress->save();



        return redirect()->route('user.address')->with('success', 'Dirección añadida correctamente.');
    }

    public function delete($id)
    {

        $address = Address::find($id);
        if (!$address) {
            return redirect()->back()->with('error', 'La dirección no existe');
        }
        $address->delete();

        return redirect()->back()->with('success', 'Direccion eliminada correctamete');
    }

    public function favourite($id)
    {

        $user = Auth::user();

        $address = Address::find($id);
        if (!$address) {
            return redirect()->back()->with('error', 'La dirección no existe');
        }

        foreach ($user->addresses as $userAddress) {
            if($userAddress->favourite==1){
                $userAddress->favourite=0;
                $userAddress->save();
            }
        }

        $address->favourite = 1;

        $address->save();

        return redirect()->back()->with('success', 'Direccion marcada correctamete');
    }
}
