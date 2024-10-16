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
        Schema::table('mid_answers', function (Blueprint $table) {
            $table->integer('input_count')->nullable()->after('answer_type');
            $table->string('radio_group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mid_answers', function (Blueprint $table) {
            $table->dropColumn('input_count');
            $table->dropColumn('radio_group');
        });
    }
};
