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
        Schema::table('product', function (Blueprint $table) {
            $table->integer('stock_quantity')->default(0)->after('product_status');
            $table->boolean('in_stock')->default(true)->after('stock_quantity');
            $table->json('product_specs')->nullable()->after('in_stock');
            $table->json('product_images')->nullable()->after('product_image');
            $table->string('color')->nullable()->after('product_images');
            $table->string('capacity')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('stock_quantity');
            $table->dropColumn('in_stock');
            $table->dropColumn('product_specs');
            $table->dropColumn('product_images');
            $table->dropColumn('color');
            $table->dropColumn('capacity');
        });
    }
};
