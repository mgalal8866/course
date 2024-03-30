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
        Schema::create('orders_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id')->nullable();
            $table->boolean('is_book')->nullable();
            $table->uuid('coupon_id')->nullable();
            $table->string('qty')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('subtotal',8,2)->nullable();
            $table->decimal('discount',8,2)->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
    }
};
