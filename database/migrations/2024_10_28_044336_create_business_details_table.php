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
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable()->default(null);
            $table->string('middle_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('gender', 10)->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('preffered')->nullable()->default(null);
            $table->integer('total_person')->nullable()->default(null);
            $table->integer('boy_therapist')->nullable()->default(null);
            $table->integer('girl_therapist')->nullable()->default(null);
            $table->string('date')->nullable()->default(null);
            $table->string('time')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('offers_type')->nullable()->default(null);
            $table->string('payment_total')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_details');
    }
};
