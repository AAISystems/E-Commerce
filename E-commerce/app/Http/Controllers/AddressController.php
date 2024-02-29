<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    /*Metodo para mostrar las CRUD de las direcciones
     */
    public function show()
    {

        $user = Auth::user();
        $userAddresses = $user->addresses;
        $categories = Category::where('show', true)->get();

        return view('userSettings.address', compact('userAddresses','categories'));
    }

    public function prepare(){
        $categories = Category::where('show', true)->get();
        return view('userSettings.createAddress', compact('categories'));
    }

    public function create(Request $request)
    {

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'pc' => 'required|numeric|digits:5',
            'street' => 'required|string',
            'number' => 'required|numeric',
            'floor' => 'nullable|numeric',
            'door' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back() 
                ->withErrors($validator)
                ->withInput();
        }

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

    public function edit($id){
        $user = Auth::user();
        $categories = Category::where('show', true)->get();

        $address = Address::find($id);
        if (!$address) {
            return redirect()->back()->with('error', 'La dirección no existe');
        }


        return view('userSettings.edit',compact('address','categories'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'pc' => 'required|numeric|digits:5',
            'street' => 'required|string',
            'number' => 'required|numeric',
            'floor' => 'nullable|numeric',
            'door' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back() 
                ->withErrors($validator)
                ->withInput();
        }

        $address = Address::find($request->id);
        if (!$address) {
            return redirect()->back()->with('error', 'La dirección no existe');
        }

       //Recojo los datos de la direccion
       $data = $request->all();
       //Elimino el _token porque no forma parte de la direccion
       unset($data['_token'],$data['id']);

       $completeAddress = '';


       foreach ($data as $key => $value) {
           $completeAddress = $completeAddress . ' ' . $value;
           $address->$key = $value;
       }


       $address->dataAddress = $completeAddress;
       $address->user_id = $user->id;
       $address->save();

        $address->favourite = 1;

        $address->save();

        return redirect()->route('user.address')->with('success', 'Direccion actualizada correctamete');
    }
}
