<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autores';
    protected $fillable = ['nome', 'email', 'descricao'];

    protected string $nome;
    protected string $email;
    protected string $descricao;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
