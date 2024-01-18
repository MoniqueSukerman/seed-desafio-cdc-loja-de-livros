<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'nome' => 'required|unique:categorias,nome'
            ]);

            $categoria = new Categoria([
                'nome' => $request->input('nome')
            ]);

            $categoria->save();

            return response()->json(['categoria' => $categoria], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
