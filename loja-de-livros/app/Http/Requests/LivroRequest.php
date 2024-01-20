<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|unique:livros,titulo',
            'resumo' => 'required|max:500',
            'sumario' => 'nullable',
            'preco' => 'required|numeric|min:20',
            'numero_paginas' => 'required|integer|min:100',
            'isbn' => 'required|unique:livros,isbn',
            'data_publicacao' => 'required|date|after:tomorrow',
            'categoria_id' => 'required',
            'autor_id' => 'required',
        ];
    }
}
