<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_files', function (Blueprint $table) {
            $table->dropColumn(['component_id', 'area_id', 'device_id', 'inspection_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_files', function (Blueprint $table) {
            $table->unsignedBigInteger('component_id')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('inspection_id');
        });
    }
};
