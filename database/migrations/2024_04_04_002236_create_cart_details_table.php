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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cart_header');
            $table->uuid('product_id');
            $table->uuid('coupon_id')->nullable();
            $table->boolean('is_book');
            $table->integer('qty');
            $table->decimal('price',8,2)->default(0);
            $table->decimal('subtotal',8,2)->default(0);
            $table->decimal('discount',8,2)->default(0);
            $table->decimal('total',8,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
