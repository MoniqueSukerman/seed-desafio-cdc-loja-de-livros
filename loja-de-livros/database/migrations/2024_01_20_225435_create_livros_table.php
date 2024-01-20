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
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->unique()->required();
            $table->text('resumo')->required()->max(500);
            $table->text('sumario')->required();
            $table->decimal('preco', 8, 2)->required()->min(20);
            $table->integer('numero_paginas')->required()->min(100);
            $table->string('isbn')->required()->unique();
            $table->date('data_publicacao')->required()->futureDate();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('autor_id');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('autor_id')->references('id')->on('autores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
