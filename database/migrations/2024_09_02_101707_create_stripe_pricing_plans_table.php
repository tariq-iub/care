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
        Schema::create('stripe_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('stripe_products')->onDelete('cascade');
            $table->string('stripe_price_id')->unique();
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 16, 2);
            $table->string('currency', 3);
            $table->string('billing_period');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_pricing_plans');
    }
};
