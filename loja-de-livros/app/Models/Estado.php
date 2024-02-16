<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';
    protected $fillable = [
        'nome',
        'pais_id'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class);
    }

}
