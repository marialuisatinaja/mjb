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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->nullable()->default(null);
            $table->string('service_type')->nullable()->default(null);
            $table->string('first_name')->nullable()->default(null);
            $table->string('middle_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('gender', 10)->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('preffered')->nullable()->default(null);
            $table->string('total_person')->nullable()->default(null);
            $table->string('boy_therapist')->nullable()->default(null);
            $table->string('girl_therapist')->nullable()->default(null);
            $table->string('message')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
