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
        Schema::create('carts_has_products', function (Blueprint $table) {
            $table->id();
            $table->integer('carts_idCarts');
            $table->integer('carts_orders_id');
            $table->integer('products_idproducts');
            $table->integer('quantity');
            $table->timestamps();

            
            $table->foreign('carts_idCarts')->references('id')->on('carts');
            $table->foreign('carts_orders_id')->references('id')->on('orders');
            $table->foreign('products_idproducts')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_has_products');
    }
};
