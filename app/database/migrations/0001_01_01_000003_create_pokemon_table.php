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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id(); // ID do Pokémon
            $table->string('nome'); // Nome do Pokémon
            $table->integer('peso'); // Peso do Pokémon em gramas ou outro formato
            $table->integer('altura'); // Altura do Pokémon em centímetros ou outro formato
            $table->string('tipo'); // Tipo do Pokémon representado como um inteiro
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }

};
