<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $fillable = [
        'email',
        'nome',
        'sobrenome',
        'documento',
        'endereco',
        'complemento',
        'cidade',
        'pais_id',
        'estado_id',
        'telefone',
        'cep',
        'status',
        'total_compra',
        'cupom_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function itens()
    {
        return $this->hasMany(CompraItem::class);
    }

    public function getCupomId()
    {
        return $this->cupom_id;
    }

    public function getValorTotal()
    {
        return $this->total_compra;
    }
}
