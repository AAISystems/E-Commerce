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
            $table->integer("amount");
            $table->integer("total_products");
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('carts_orders_id');
            $table->foreign('users_id')->references('id')->on('users');
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
