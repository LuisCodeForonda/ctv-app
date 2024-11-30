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
        Schema::create('detalle_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mantenimiento_id')->nullable()->constrained('mantenimientos')->cascadeOnUpdate()->nullOnDelete();
            $table->tinyInteger('tipo')->default(1);
            $table->longText('descripcion', 500);
            $table->float('costo');
            $table->string('observacion', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_mantenimientos');
    }
};
