<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');

    	$data['error'] = true;

    	if (auth()->attempt(['email' => $email, 'password' => $password])) {
    		$data['error'] = false;
    		$data['user'] = auth()->user();
        }

        return $data;
    }
}
