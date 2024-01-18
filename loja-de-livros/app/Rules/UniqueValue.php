<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueValue implements ValidationRule
{
    protected string $table;
    protected string $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = DB::table($this->table)
            ->where($this->column, $value)
            ->count();

        if ($result > 0) {
            $fail("O valor $attribute já está em uso.");
        }

    }
}
