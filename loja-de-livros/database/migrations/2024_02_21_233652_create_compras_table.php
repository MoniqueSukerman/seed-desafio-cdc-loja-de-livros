<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(false);
            $table->string('nome')->nullable(false);
            $table->string('sobrenome')->nullable(false);
            $table->string('documento')->nullable(false);
            $table->string('endereco')->nullable(false);
            $table->string('complemento')->nullable(false);
            $table->string('cidade')->nullable(false);
            $table->unsignedBigInteger('pais_id')->nullable(false);
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->string('telefone')->nullable(false);
            $table->string('cep')->nullable(false);
            $table->string('status')->nullable(false);
            $table->float('total_compra')->required()->greaterThan(0);
            $table->timestamps();

            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('estado_id')->references('id')->on('estados');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
