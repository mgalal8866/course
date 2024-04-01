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
        Schema::create('content_us', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('type')->comment('0=work with elyuser  1=content to owner')->nullable();
            $table->string('name')->nullable();
            $table->string('mail')->nullable();
            $table->string('phone')->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_us');
    }
};
