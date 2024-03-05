<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AddressValidator;
use App\Models\Address;


class AddressController extends Controller
{
    private $addressValidator;

    public function __construct(AddressValidator $addressValidator) {
        $this->addressValidator = $addressValidator;
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $is_validated = $this->addressValidator->validate($request->all());
        if(!$is_validated){
            return response()->json(['success' => false, 'message' => 'Address walidation error']);
        }
        $address = new Address();
        $address->user_id = $request->user_id;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->postal_code = $request->postal_code;
        $address->save();
        return response()->json(['success' => true, 'message' => 'Address created successfully']);
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $is_validated = $this->addressValidator->validate($request->all());
        if(!$is_validated){
            return response()->json(['success' => false, 'message' => 'Address walidation error']);
        }
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return response()->json(['success' => true, 'message' => 'Address edited successfully']);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(['success' => true, 'message' => 'Address deleted successfully']);
    }
}
