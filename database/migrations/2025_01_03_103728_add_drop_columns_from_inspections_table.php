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
        Schema::table('inspections', function (Blueprint $table) {
            // Dropping unnecessary columns
            $table->dropColumn([
                'type',
                'scheduled_at',
                'visitor_name',
                'taken_up'
            ]);

            // Adding new column
            $table->enum('inspection', ['Routine', 'Emergency', 'Post-Maintenance'])->default('Routine')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            // Restoring removed columns
            $table->enum('type', ['visit', 'remote'])->default('visit');
            $table->dateTime('scheduled_at');
            $table->string('visitor_name')->nullable();
            $table->boolean('taken_up')->default(false);

            // Dropping newly added column
            $table->dropColumn('inspection');
        });
    }
};
