<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use Illuminate\Http\Request;
use Str;

class ClientController extends Controller
{
    public function client_dashboard()
    {
        $active = " dashboard";
        return view('client.dashboard',compact('active'));
    }
    public function add_client_page()
    {
        $active = "add-client";
        return view('admin.add_client', compact('active'));
    }
    public function add_client_post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15|numeric',
            'website_link' => 'required|url',
            'api_link' => 'required',
        ]);
        $firstLetter = Str::lower(substr($request->name, 0, 3));
        $randomNumber = rand(10000, 99999);
        $user_id = $firstLetter . $randomNumber;
        $password = Str::random(8);


        function generateUniqueApiKey()
        {
            do {
                $api_key = Str::random(32);
            } while (ClientsModel::where('api_key', $api_key)->exists());

            return $api_key;
        }
        $unique_api_key = generateUniqueApiKey();
        ClientsModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website_link' => $request->website_link,
            'api_link' => $request->api_link,
            'user_id' => $user_id,
            'password' => $password,
            'api_key' => $unique_api_key,
        ]);
        return redirect()->back()->with('success', 'Client added successfully!');
    }
    public function all_client_list()
    {
        $active = "client-list";
        $clients = ClientsModel::all();
        return view('admin.all_client_list', compact('active', 'clients'));
    }
    public function delete_client($clientId)
    {
        ClientsModel::findOrFail($clientId)->delete();
        return redirect()->back()->with('success', 'Client deleted successfully!');
    }
    public function edit_client($clientId)
    {
        $active = "client-list";
        $client = ClientsModel::findOrFail($clientId);
        return view('admin.edit_client', compact('active', 'client'));
    }
    public function edit_client_post(Request $request, $clientId)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:10,15|numeric',
            'website_link' => 'required|url',
            'api_link' => 'required',
        ]);
        $status = 0;
        if ($request->status === "on") {
            $status = 1;
        }
        ClientsModel::findOrFail($clientId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website_link' => $request->website_link,
            'api_link' => $request->api_link,
            'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Client updated successfully!');
    }
}
