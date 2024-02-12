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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("sellerName");
            $table->string('sellerNIF');
            $table->string('sellerAddress');
            $table->date('date');
            $table->string('userName');
            $table->string('userNIF');
            $table->string('userAddress');
            $table->float('total');

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
