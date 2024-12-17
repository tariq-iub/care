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
        Schema::create('forcing_frequencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mid_setup_id')->constrained('mid_setups')->onDelete('cascade');
            $table->string('code');
            $table->string('multiple');
            $table->string('name');
            $table->boolean('on_secondary');
            $table->string('elements');
            $table->decimal('final_ratio', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forcing_frequencies');
    }
};
