<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'nome' => 'required|unique:estados,nome',
                'pais_id' => 'required',
            ]);

            $estado = new Estado([
                'nome' => $request->input('nome'),
                'pais_id' => $request->input('pais_id'),
            ]);

            $estado->save();

            return response()->json(['estado' => $estado], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
