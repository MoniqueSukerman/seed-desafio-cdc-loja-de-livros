<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use App\Rules\UniqueValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'codigo' => ['required', 'string', new UniqueValue('cupons', 'codigo')],
                'percentual' => 'required|numeric|gt:0',
                'validade' => 'required|date|after:tomorrow',
            ]);

            $cupom = new Cupom([
                'codigo' => $request->input('codigo'),
                'percentual' => $request->input('percentual'),
                'validade' => $request->input('validade')
            ]);

            $cupom->save();

            return response()->json(['cupom' => $cupom], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
