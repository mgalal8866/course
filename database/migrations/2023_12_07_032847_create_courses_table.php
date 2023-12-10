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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->string('schedule');
            $table->string('price');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('image');
            $table->string('conditions');// شروط واحكام
            $table->string('telegram');
            $table->string('timeline'); //ألخطه الزمنية
            $table->string('time');
            $table->string('video'); // فيديو تعريفى
            $table->integer('category_id');
            $table->string('validity'); //صلاحية الدورة
            $table->string('duration'); //مده الدورة
            $table->string('max_drainees'); //الحد الاقصي لمتدربين
            $table->string('link_free');
            $table->string('how_start');
            $table->string('target');
            $table->string('next_cource');
            $table->string('lang');
            $table->string('statu');
            $table->string('price_print');
            $table->string('file_work');
            $table->string('file_explanatory');
            $table->string('file_aggregates');
            $table->string('file_supplementary');
            $table->string('file_free');
            $table->string('file_test');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
