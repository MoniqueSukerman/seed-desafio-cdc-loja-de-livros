<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';
    protected $fillable = [
        'titulo',
        'resumo',
        'sumario',
        'preco',
        'quantidade_paginas',
        'isbn',
        'data_publicacao',
        'categoria',
        'autor'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($livro) {
            if ($livro->data_publicacao < now()) {
                return false; // Impede a salvamento se a data de publicação não for no futuro
            }
        });
    }

}
