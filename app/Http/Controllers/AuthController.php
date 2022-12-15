<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_phone_number' => [
                'required',
                'regex:/^[a-zA-z0-9_\-.]{1,30}@[a-zA-z0-9_\-]{1,30}\.[a-zA-z0-9]{1,10}$|^[0-9]{9,12}$/'
            ],
            'password' => 'required'
        ]);
        if (strpos($credentials['email_or_phone_number'], '@') === false) {
            $credentials['phone_number'] = $credentials['email_or_phone_number'];
        } else {
            $credentials['email'] = $credentials['email_or_phone_number'];
        }
        unset($credentials['email_or_phone_number']);

        if (!$this->guard()->attempt($credentials)) {
            return response()->json([

                'message' => 'The provided credentials are incorrect.'
            ], 500);
        }

        $token = $this->guard()->user()->createToken('auth-token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $this->guard()->logout();
        return response()->json([
            'status_code' => '200',
            'message' => 'logged out successfully'
        ]);
    }

    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }
}
