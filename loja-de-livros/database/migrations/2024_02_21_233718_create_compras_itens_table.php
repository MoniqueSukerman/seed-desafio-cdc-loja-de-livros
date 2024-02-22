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
        Schema::create('compras_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('livro_id')->nullable(false);
            $table->integer('quantidade')->nullable(false)->graterThan(0);
            $table->float('preco')->nullable(false)->graterThan(0);
            $table->unsignedBigInteger('compra_id')->nullable(false);
            $table->timestamps();

            $table->foreign('livro_id')->references('id')->on('livros');
            $table->foreign('compra_id')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_itens');
    }
};
