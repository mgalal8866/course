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
            $table->string('name')->nullable();
            $table->uuid('country_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->string('description')->nullable();
            $table->string('short_description')->nullable();
            $table->boolean('course_gender')->nullable();
            $table->string('price')->nullable();
            $table->string('pricewith')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('image')->nullable();
            $table->string('telegram')->nullable();
            $table->string('telegramgrup')->nullable();
            $table->string('timeline')->nullable(); //ألخطه الزمنية
            $table->string('time')->nullable();
            $table->string('video')->nullable(); // فيديو تعريفى
            $table->string('validity')->nullable(); //صلاحية الدورة
            $table->string('duration')->nullable(); //مده الدورة
            $table->string('max_drainees')->nullable(); //الحد الاقصي لمتدربين
            $table->text('features')->nullable();
            $table->text('conditions')->nullable();// شروط واحكام
            $table->text('how_start')->nullable();
            $table->text('target')->nullable();
            $table->string('next_cource')->nullable();
            $table->boolean('inputnum')->default(0);
            $table->boolean('lang')->default(0);
            $table->boolean('statu')->default(1);
            $table->string('price_print');
            $table->string('file_schedule');
            $table->string('link_free');
            $table->string('file_work');
            $table->string('file_explanatory');
            $table->string('file_aggregates');
            $table->string('file_supplementary');
            $table->string('file_free');
            $table->string('file_test');
            $table->softDeletes();
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
