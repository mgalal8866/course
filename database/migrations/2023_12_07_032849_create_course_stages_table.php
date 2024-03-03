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
        Schema::create('course_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('course_id')->index();
            $table->uuid('lesson_id')->index();
            $table->uuid('stage_id')->index();
            $table->timestamps();
            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('stage_id')->references('id')->on('stages');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_stages');
    }
};
