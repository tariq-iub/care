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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('machine_name');
            $table->foreignId('mid_setup_id')->constrained('mid_setups')->onDelete('cascade');
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('area_id');
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
