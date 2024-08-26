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
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('username'); // 255 chars by default
            $table->string('email'); // Consider adding unique() if needed
            $table->string('phone_no');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('company_city');
            $table->string('company_state')->nullable();
            $table->string('company_zip')->nullable();
            $table->string('company_country')->nullable();
            $table->unsignedBigInteger('responder_id')->nullable(); // Make nullable if optional
            $table->longText('remarks')->nullable(); // Make nullable if optional
            $table->timestamp('user_created_at')->nullable();
            $table->timestamp('company_registration_date')->nullable();
            $table->timestamp('client_emailed')->nullable();
            $table->boolean('client_registered')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_registrations');
    }
};
