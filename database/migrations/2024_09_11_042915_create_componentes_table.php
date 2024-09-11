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
        Schema::create('componentes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 100);
            $table->string('observaciones', 30)->nullable();
            $table->string('modelo', 30)->nullable();
            $table->string('serie', 30)->nullable();
            $table->integer('cantidad')->default(1);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('equipo_id')->nullable()->constrained('equipos')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes');
    }
};
