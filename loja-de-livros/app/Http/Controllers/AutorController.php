<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:authors,email',
            'descricao' => 'required|max:400',
        ]);

//            $author = Autor::create([
//                'nome' => $request->input('name'),
//                'email' => $request->input('email'),
//                'descricao' => $request->input('description'),
//            ]);

        $author = new Autor($request->input('nome'), $request->input('email'), $request->input('descricao'));

            return response()->json(['author' => $author], 200);
        }
}
