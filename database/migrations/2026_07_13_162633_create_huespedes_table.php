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
        Schema::create('huespedes', function (Blueprint $table) {

    $table->id();

    $table->string('tipo_documento',20);

    $table->string('numero_documento',20)->unique();

    $table->string('nombres');

    $table->string('apellidos');

    $table->string('telefono',20);

    $table->string('correo')->nullable();

    $table->string('direccion')->nullable();

    $table->string('ciudad')->nullable();

    $table->date('fecha_registro');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('huespedes');
    }
};
