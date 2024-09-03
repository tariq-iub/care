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
        Schema::create('pricing_plan_feature_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_plan_id')->constrained('stripe_pricing_plans')->onDelete('cascade');
            $table->foreignId('feature_id')->constrained('pricing_plan_features')->onDelete('cascade');
            $table->boolean('is_available')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plan_feature_assignments');
    }
};
