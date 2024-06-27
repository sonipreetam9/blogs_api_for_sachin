<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use Illuminate\Http\Request;
use Auth;

class ClientAuthController extends Controller
{
    public function client_login_page(){
        if (Auth::guard('client')->check()) {
            return redirect()->route('client.dashboard');
        } else {
            return view('client.login');
        }
    }
    public function client_login_checking(Request $request)
    {
        // Validate the input
        $request->validate([
            'user_id' => ['required', 'regex:/^[^><{}\[\]!@&|=]*$/'],
            'password' => ['required', 'regex:/^[^><{}\[\]!@&|=]*$/']
        ], [
            'user_id.regex' => 'The user ID contains invalid characters.',
            'password.regex' => 'The password contains invalid characters.'
        ]);


        $client = ClientsModel::where('user_id', $request->user_id)->first();

        if ($client) {

            if ($request->password === $client->password) {

                Auth::guard('client')->login($client);


                return redirect()->route('client.dashboard');
            } else {

                return redirect()->back()->with('error', 'Invalid User ID or Password');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid User ID or Password');
        }
    }
    public function client_logout() {
        Auth::guard('client')->logout();
        return redirect()->route('client.login.page');
    }

}
