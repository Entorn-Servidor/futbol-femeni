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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            
            // Relaciones con claves foráneas
            // Si se borra el equipo o estadio, el campo se pone a null (set null)
            $table->foreignId('local_id')->nullable()->constrained('equips')->onDelete('set null');
            $table->foreignId('visitant_id')->nullable()->constrained('equips')->onDelete('set null');
            $table->foreignId('estadi_id')->nullable()->constrained('estadis')->onDelete('set null');

            // Campos de información del partido
            $table->date('data');
            $table->integer('jornada')->nullable();
            
            // Guardaremos los goles como un JSON (ej: {"local": 2, "visitant": 1})
            $table->json('gols')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};