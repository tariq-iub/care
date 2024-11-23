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
        Schema::create('mid_generals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mid_setup_id')->constrained('mid_setups')->onDelete('cascade');
            $table->decimal('nominal_speed', 10, 2);
            $table->string('speed_unit');
            $table->decimal('secondary_speed_ratio', 10, 2);
            $table->string('mid_rating');
            $table->string('machine_orientation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mid_generals');
    }
};
