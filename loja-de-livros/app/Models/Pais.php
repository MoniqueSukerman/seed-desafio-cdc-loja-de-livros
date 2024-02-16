<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'paises';
    protected $fillable = [
        'nome',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function estados()
    {
        return $this->hasMany(Estado::class);
    }

    public function getEstados()
    {
        return $this->estados;
    }
}
