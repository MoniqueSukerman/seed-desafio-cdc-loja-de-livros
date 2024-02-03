<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'titulo' => 'required|unique:livros,titulo',
                'resumo' => 'required|max:500',
                'sumario' => 'nullable',
                'preco' => 'required|numeric|min:20',
                'numero_paginas' => 'required|integer|min:100',
                'isbn' => 'required|unique:livros,isbn',
                'data_publicacao' => 'required|date|after:tomorrow',
                'categoria_id' => 'required',
                'autor_id' => 'required',
            ]);

            $livro = new Livro([
                'titulo' => $request->input('titulo'),
                'resumo' => $request->input('resumo'),
                'sumario' => $request->input('sumario'),
                'preco' => $request->input('preco'),
                'numero_paginas' => $request->input('numero_paginas'),
                'isbn' => $request->input('isbn'),
                'data_publicacao' => $request->input('data_publicacao'),
                'categoria_id' => $request->input('categoria_id'),
                'autor_id' => $request->input('autor_id'),
            ]);

//             echo $request->input('numero_paginas');
//             die();

            $livro->save();

            return response()->json(['livro' => $livro], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
