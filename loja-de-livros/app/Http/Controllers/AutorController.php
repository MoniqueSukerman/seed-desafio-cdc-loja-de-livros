<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Rules\UniqueValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'nome' => 'required',
//                'email' => 'required|email|unique:autores,email',
                'email' => ['required', 'email', new UniqueValue('autores', 'email')],
                'descricao' => 'required|max:400',
            ]);

            $autor = new Autor([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'descricao' => $request->input('descricao'),
            ]);

            $autor->save();

            return response()->json(['autor' => $autor], 200);
        } catch (\Exception $exception) {
            return new JsonResponse(['Mensagem' => $exception->getMessage()], 400);
        }

    }
}
