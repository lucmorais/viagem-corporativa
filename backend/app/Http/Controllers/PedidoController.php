<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $user = auth()->guard()->user();
        $papel = Papel::find($user->idPapel);

        $pedidos = Pedido::with('usuario:id,nome')
        ->when($papel->permissao !== 'admin', function ($query) use ($user) {
            $query->where('idUsuario', $user->id);
        })
        ->get()
        ->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'destino' => $pedido->destino,
                'dataIda' => $pedido->dataIda,
                'dataVolta' => $pedido->dataVolta,
                'status' => $pedido->status,
                'solicitante' => $pedido->usuario->nome,
            ];
        });

        return response()->json($pedidos, 200);
    }

    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return response()->json($pedido, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'destino' => 'required|string',
            'dataIda' => 'required|date',
            'dataVolta' => 'required|date',
            'idUsuario' => 'required|exists:usuario,id',
        ]);

        $data['status'] = 'solicitado';

        $pedido = Pedido::create($data);
        return response()->json($pedido, 201);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }
}
