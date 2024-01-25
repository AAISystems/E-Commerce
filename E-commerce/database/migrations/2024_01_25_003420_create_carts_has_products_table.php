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
            $table->unsignedBigInteger('carts_id');
            $table->unsignedBigInteger('carts_orders_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('quantity');
            

            
            $table->foreign('carts_id')->references('id')->on('carts');
            $table->timestamps();
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
