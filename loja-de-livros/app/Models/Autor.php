<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected string $nome;
    protected string $email;
    protected string $descricao;

    /**
     * @param string $nome
     * @param string $email
     * @param string $descricao
     */
    public function __construct(string $nome, string $email, string $descricao)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->descricao = $descricao;
    }

}
