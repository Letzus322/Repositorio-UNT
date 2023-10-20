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
        Schema::create('carpetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCarpeta');
            $table->unsignedBigInteger('padre')->nullable(); // Si padre puede ser nulo, de lo contrario, elimina '->nullable()'
            $table->foreign('padre')->references('id')->on('carpetas')->onDelete('set null'); // Asegúrate de tener una relación adecuada con la misma tabla si es necesario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpetas');
    }
};
