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
            $table->string('name');
            $table->string('type');
            $table->string('description');
            $table->string('vin')->unique();
            $table->integer('km');
            $table->integer('fuel_level');
            $table->json('wheel_percentages')->nullable();
            $table->text('damages')->nullable();
            $table->string('photo_url');
            $table->string('engine_type');
            $table->integer('power');
            $table->float('acceleration');
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
