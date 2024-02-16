<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'nome' => 'required|unique:paises,nome',
            ]);

            $pais = new Pais([
                'nome' => $request->input('nome'),
            ]);

            $pais->save();

            return response()->json(['pais' => $pais], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
