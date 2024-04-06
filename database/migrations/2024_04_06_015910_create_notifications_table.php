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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('title')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->uuid('user_id');
            $table->integer('type')->comment('0=nothing  1=_to_cource  2=to_book 3=to_purchase' );
            $table->uuid('redirect_id')->nullable();
            $table->boolean('is_read')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
