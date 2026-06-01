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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maker_id')->constrained();
            $table->foreignId('model_id')->constrained();
            $table->foreignId('car_type_id')->constrained();
            $table->foreignId('fuel_type_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->integer('year');
            $table->decimal('price', 12, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
