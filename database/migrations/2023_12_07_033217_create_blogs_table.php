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
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('views')->nullable();
            $table->text('short')->nullable();
            $table->longText('article')->nullable();
            $table->string('writer')->nullable();
            $table->json('tags')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_image')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
