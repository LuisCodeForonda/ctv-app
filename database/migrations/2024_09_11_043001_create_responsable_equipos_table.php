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
        Schema::create('responsable_equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responsable_id')->nullable()->constrained('responsables')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('equipo_id')->nullable()->constrained('equipos')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamp('fecha_asignacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsable_equipos');
    }
};
