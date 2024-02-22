<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;
    protected $table = 'cupons';
    protected $fillable = ['codigo', 'percentual', 'validade'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
