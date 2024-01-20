<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use Illuminate\Http\JsonResponse;

class LivroController extends Controller
{
    public function store(LivroRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $livro = new Livro($request->validated());

            $livro->save();

            return response()->json(['livro' => $livro], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
