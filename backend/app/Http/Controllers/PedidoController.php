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
                'dataIda' => date('d/m/Y', strtotime($pedido->dataIda)),
                'dataVolta' => date('d/m/Y', strtotime($pedido->dataVolta)),
                'status' => $pedido->status,
                'solicitante' => $pedido->usuario->nome,
            ];
        });

        return response()->json($pedidos, 200);
    }

    public function show($id)
    {
        $pedido = Pedido::with('usuario:id,nome')->findOrFail($id);
        $pedido->dataIda = date('d/m/Y', strtotime($pedido->dataIda));
        $pedido->dataVolta = date('d/m/Y', strtotime($pedido->dataVolta));
        $pedido->solicitante = $pedido->usuario->nome ?? 'N/A';
        unset($pedido->usuario);

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

    public function filtrarPedidos(Request $request)
    {
        $user = auth()->guard()->user();
        $papel = Papel::find($user->idPapel);

        $pedidos = Pedido::with('usuario:id,nome')
        ->when($papel->permissao !== 'admin', function ($query) use ($user) {
            $query->where('idUsuario', $user->id);
        })
        ->when($request->filled('solicitante'), function ($query) use ($request) {
            $query->whereHas('usuario', function ($subQuery) use ($request) {
                $subQuery->where('nome', 'like', '%' . $request->solicitante . '%');
            });
        })
        ->when($request->filled('destino'), function ($query) use ($request) {
            $query->where('destino', 'like', '%' . $request->destino . '%');
        })
        ->when($request->filled('dataIda'), function ($query) use ($request) {
            $query->whereDate('dataIda', $request->dataIda);
        })
        ->when($request->filled('dataVolta'), function ($query) use ($request) {
            $query->whereDate('dataVolta', $request->dataVolta);
        })
        ->when($request->filled('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->get()
        ->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'destino' => $pedido->destino,
                'dataIda' => date('d/m/Y', strtotime($pedido->dataIda)),
                'dataVolta' => date('d/m/Y', strtotime($pedido->dataVolta)),
                'status' => $pedido->status,
                'solicitante' => $pedido->usuario->nome ?? 'N/A',
            ];
        });

        return response()->json($pedidos, 200);
    }
}
