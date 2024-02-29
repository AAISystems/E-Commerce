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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("dataAddress");
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->integer('pc');
            $table->string('street');
            $table->integer('number');
            $table->string('floor')->nullable();
            $table->string('door')->nullable();
            $table->boolean('favourite')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
