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
        Schema::create('machine_process_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_info_id')->constrained('machine_infos')->onDelete('cascade'); // Foreign key
            $table->string('point_name');
            $table->string('id_tag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_process_points');
    }
};
