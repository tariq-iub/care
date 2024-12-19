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
            $table->unsignedBigInteger('device_id')->nullable()->after('file_path')->change();
            $table->unsignedBigInteger('machine_id')->after('device_id')->change();
            $table->unsignedBigInteger('vibration_location_id')->after('machine_id')->change();
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
