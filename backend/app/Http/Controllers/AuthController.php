<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuario',
            'senha' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $usuario = Usuario::create([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'senha' => Hash::make($request->get('senha')),
        ]);

        $token = JWTAuth::fromUser($usuario);

        return response()->json(compact('usuario','token'), 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('usuario', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }

            $usuario = auth()->guard()->user();

            $token = JWTAuth::fromUser($usuario);

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }
    }

    public function getUser()
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

            return response()->json($usuario->getJWTCustomClaims(), 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido'], 400);
        }

        return response()->json(compact('usuario'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}