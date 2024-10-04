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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->string('amount')->nullable()->default(null);
            $table->string('hours')->nullable()->default(null);
            $table->string('minutes')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('upload')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
