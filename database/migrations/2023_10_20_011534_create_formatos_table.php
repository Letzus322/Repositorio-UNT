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
        Schema::create('formatos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreFormato');
            $table->integer('año');
            // Agrega otras columnas si es necesario

            $table->timestamps(); // Creado y actualizado en

            // Define las claves foráneas si es necesario
            // $table->foreign('otra_columna')->references('id')->on('otra_tabla');

            // Agrega índices si es necesario
            // $table->index('nombre_columna');

            // Agrega restricciones únicas si es necesario
            // $table->unique('nombre_columna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formatos');
    }
};
