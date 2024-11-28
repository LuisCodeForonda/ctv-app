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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->longText('observaciones')->nullable();
            $table->string('modelo', 30)->nullable();
            $table->string('serie', 30)->nullable();
            $table->string('serietec')->unique();
            $table->tinyInteger('estado')->default(1);
            $table->string('area', 30)->nullable();
            $table->string('slug', 50)->unique();
            $table->string('ubicacion', 50)->nullable();
            $table->foreignId('marca_id')->nullable()->default(null)->constrained('marcas')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('categoria_id')->nullable()->default(null)->constrained('categorias')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
