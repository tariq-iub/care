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
        Schema::table('data_files', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('vibration_location_id');


            // Adding foreign key constraints
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machine_infos')->onDelete('cascade');
            $table->foreign('vibration_location_id')->references('id')->on('machine_vibration_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_files', function (Blueprint $table) {
            $table->dropForeign(['device_id']);
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['vibration_location_id']);
            $table->dropColumn(['device_id', 'machine_id', 'vibration_location_id']);
        });
    }
};
