<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiMessages;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
    public function login(Request $request){

        $credenciais = $request->all(['email', 'password']);

        Validator::make($credenciais, [
            'email' => 'required|string',
            'password' => 'required|string',
        ])->validate();


        if (!$token = auth('api')->attempt($credenciais)){
            $message = new ApiMessages('Nao autorizado');
            return response()->json($message->getMessage(), 401);
        }

        return response()->json([

            'token' =>$token
        ]);

    }


    public function logout(){

        auth('api')->logout();
        return response()->json(['message' => 'Logout com sucesso'], 200);

    }

    public function refresh(){
        $token = auth('api')->refresh();

        return response()->json([

            'token' =>$token
        ]);
    }
}
