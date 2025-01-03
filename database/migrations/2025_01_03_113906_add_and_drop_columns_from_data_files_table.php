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
            // Dropping old columns if they exist
            $table->dropColumn(['component_id', 'area_id', 'inspection_id']);

            // Adding new columns
            $table->unsignedBigInteger('machine_id')->nullable()->after('device_id');
            $table->unsignedBigInteger('vibration_location_id')->nullable()->after('machine_id');

            // Adding foreign key constraints
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('vibration_location_id')->references('id')->on('machine_vibration_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_files', function (Blueprint $table) {
            //
        });
    }
};
