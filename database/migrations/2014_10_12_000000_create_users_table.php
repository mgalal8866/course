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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('phone_parent')->nullable();
            $table->string('email_parent')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->uuid('country_id')->nullable();
            $table->boolean('gender')->nullable();
            $table->decimal('point',8,0)->default(0);
            $table->decimal('wallet',8,2)->default(0);
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->boolean('teamwork')->default(0)->comment('1= in tramwork  -  0= not show in teamwork');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('specialist')->nullable();
            $table->string('facebook')->nullable();
            $table->string('x')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('telegram')->nullable();
            $table->integer('type')->nullable()->comment('1= user - 2=trinner ');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
