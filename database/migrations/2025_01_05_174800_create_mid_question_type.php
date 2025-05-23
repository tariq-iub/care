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
        Schema::create('mid_question_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mid_question_id')->constrained('mid_questions')->onDelete('cascade');
            $table->foreignId('mid_answer_id')->nullable()->constrained('mid_answers')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mid_question_type');
    }
};
