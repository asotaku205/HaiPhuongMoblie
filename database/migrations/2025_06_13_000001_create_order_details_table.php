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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->string('product_name');
            $table->decimal('product_price', 15, 0);
            $table->integer('product_quantity');
            $table->string('product_image')->nullable();
            $table->timestamps();
            
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
}; 