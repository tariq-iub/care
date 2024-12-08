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
        Schema::table('inspections', function (Blueprint $table) {
            $table->enum('inspection_type', ['Routine', 'Emergency', 'Post-Maintenance'])->default('Routine')->after('type');
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending')->after('taken_up');
            $table->timestamp('scheduled_start')->nullable()->after('visitor_name');
            $table->timestamp('scheduled_end')->nullable()->after('scheduled_start');
            $table->timestamp('actual_start')->nullable()->after('scheduled_end');
            $table->timestamp('actual_end')->nullable()->after('actual_start');
            $table->text('remarks')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            //
        });
    }
};
