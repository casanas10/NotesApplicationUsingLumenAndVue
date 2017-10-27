<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && password_verify($request->password, $user->password)){

            if (!$user->api_token){
                $user->api_token = str_random(60);
                $user->save();
            }


            return [
                'message' => 'Successfully login.',
                'data' => $user
            ];

        } else {

            return response()->json(['error' => 'Unauthorized here'], 401);
        }
    }

    public function logout(Request $request){

        $user = $request->user();

        $user->api_key = '';

        $user->save();

        return [
            'message' => 'Successfully logout'
        ];
    }
}
