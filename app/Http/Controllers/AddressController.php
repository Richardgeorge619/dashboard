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

    function validateAddress($request)
    {
        $apiKey = config('services.google_maps.api_key');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$request->street},{$request->city},{$request->state},{$request->postalCode}&key={$apiKey}";
        try {
            $client = new Client();
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] === 'OK') {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
