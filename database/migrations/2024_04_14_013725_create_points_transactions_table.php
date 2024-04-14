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
        Schema::create('points_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('use_user_id')->nullable();
            $table->uuid('collect_user_id')->nullable();
            $table->uuid('coupon_id')->nullable();
            $table->uuid('order_id')->nullable();
            $table->integer('type');
            $table->string('point')->nullable();
            $table->string('Cash')->nullable();
            $table->string('curenty')->nullable();
            $table->string('remaining')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('points_transactions');
    }
};
