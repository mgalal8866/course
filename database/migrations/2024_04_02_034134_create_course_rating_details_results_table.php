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
        Schema::create('course_rating_details_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('course_rating_results_id')->nullable();
            $table->uuid('rating_id')->nullable();
            $table->decimal('rating',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_rating_details_results');
    }
};
