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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->integer('category_id')->unsigned();
            $table->text('product_description');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_image');
            $table->integer('product_status');
            $table->timestamps();
            
            $table->foreign('category_id')->references('category_id')->on('category_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
