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
        //Esta incompleta 
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer("amount")->nullable();
            $table->integer("total_products")->nullable();
            // $table->unsignedBigInteger('users_id')->nullable();
            // $table->unsignedBigInteger('products_id')->nullable();
            $table->unsignedBigInteger('carts_orders_id')->nullable();
            $table->foreignId('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
