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
        Schema::create('mid_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mid_setup_id')->constrained('mid_setups')->onDelete('cascade'); // Foreign key
            $table->string('component_code');
            $table->string('description');
            $table->string('pickup_code');
            $table->string('bearings_monitored');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mid_components');
    }
};
