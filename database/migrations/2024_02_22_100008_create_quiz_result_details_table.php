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
        Schema::create('quiz_result_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('result_header_id');
            $table->uuid('question_id');
            $table->uuid('answer_id');
            $table->integer('batch')->nullable();
            $table->string('marks')->nullable();
            $table->boolean('is_correct')->comment('1=>correct , 0=>notcorrest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_result_details');
    }
};
