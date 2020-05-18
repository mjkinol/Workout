<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
	public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
    	// validate the incoming data
    	$request->validate([
    		'email' => 'required',
    		'password' => 'required'
		]);

        $isLoginSuccessful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($isLoginSuccessful) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }
}
