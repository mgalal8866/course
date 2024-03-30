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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('num_order');
            $table->string('date');
            $table->string('user_id');
            $table->string('code');
            $table->string('source');
            $table->string('transaction_id');
            $table->string('blance');
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
        Schema::dropIfExists('orders');
    }
};
