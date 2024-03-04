<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
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
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(['success' => true, 'message' => 'Address deleted successfully']);
    }
    
}
