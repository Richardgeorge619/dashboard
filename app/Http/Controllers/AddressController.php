<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use GuzzleHttp\Client;

class AddressController extends Controller
{
    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $is_validated = $this->validateAddress($request);
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
        $is_validated = $this->validateAddress($request);
        if(!$is_validated){
            return response()->json(['success' => false, 'message' => 'Address walidation error']);
        }
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

    public function validateAddress($request)
    {
        // Validate the request data
        $request->validate([
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        // Make a request to SmartyStreets API
        $client = new Client();
        $response = $client->get('https://api.smartystreets.com/street-address', [
            'query' => [
                'auth-id' => '7945a380-9a5a-0336-30e5-4d2a24943e79',
                'auth-token' => 'rJ6QBbttTIIiAw7l7CUg',
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->postal_code,
            ]
        ]);

        print_r($response);
        // Process the response
        $result = json_decode($response->getBody()->getContents(), true);

        // Handle the validation result (e.g., display a message to the user)
        if (!empty($result)) {
            // Address is valid
            return true; 
        } 
        return false;
    }
    
}
