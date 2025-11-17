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
            
            // Claus foranes
            $table->foreignId('local_id')
                ->nullable()
                ->constrained('equips')
                ->onDelete('set null');
                
            $table->foreignId('visitant_id')
                ->nullable()
                ->constrained('equips')
                ->onDelete('set null');
                
            $table->foreignId('estadi_id')
                ->nullable()
                ->constrained('estadis')
                ->onDelete('set null');

            // Camps del partit
            $table->date('data');
            $table->integer('jornada')->nullable();
            
            // Columna JSON per als gols (ex: {'local': 2, 'visitant': 1})
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