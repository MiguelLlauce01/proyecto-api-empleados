<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;

class LoginApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed', RulesPassword::defaults()],
            ]
        );

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        $token = $user->createToken('Token')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    protected function credentials(Request $request){//Función que devuelve como arreglo el email y la contraseña
        return [
            'email' => strtoupper($request->input('email')),
            'password' => $request->input('password')
        ];
    }

    public function login(Request $request){
        $credentials = $this->credentials($request);
        if( !Auth::attempt($credentials )){
            return \response()->json(["mensaje"=> "Usuario es incorrecto", "state"=> 401], 200);
        }

        $accesToken = Auth::user()->createToken('authTestToken')->accessToken;

        $user = [
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'token' => $accesToken
        ];

        return \response()->json([
            'user' => $user,
            'state' => 200
        ], 200);
    }

    public function logout(){
        $token = auth()->user()->token();
        $token->revoke();
        return response()->json(['message' => 'Sesion cerrada correctamente'], 200);
    }
}
