<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idPapel' => 'required|exists:papel,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email',
            'usuario' => 'required|string|max:255|unique:usuario,usuario',
            'senha' => 'required|string|min:8',
        ]);

        $data['senha'] = bcrypt($data['senha']);

        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }
}
