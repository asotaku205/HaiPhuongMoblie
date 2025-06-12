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
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_code')->unique();
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('ward');
            $table->string('district');
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->decimal('order_total', 15, 0);
            $table->string('payment_method');
            $table->tinyInteger('payment_status')->default(0); // 0: Chưa thanh toán, 1: Đã thanh toán
            $table->tinyInteger('order_status')->default(0); // 0: Đang xử lý, 1: Đang giao hàng, 2: Đã giao hàng, 3: Đã hủy
            $table->text('order_note')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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