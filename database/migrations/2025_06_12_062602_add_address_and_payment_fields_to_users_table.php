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
        Schema::table('users', function (Blueprint $table) {
            // Địa chỉ - thêm các trường còn thiếu
            $table->string('ward')->nullable()->after('ward_id');
            $table->string('district')->nullable()->after('ward');
            $table->string('city')->nullable()->after('district');
            $table->string('postal_code')->nullable()->after('city');
            $table->string('country')->nullable()->default('Việt Nam')->after('postal_code');
            
            // Thanh toán
            $table->string('card_number')->nullable()->after('country');
            $table->string('card_expiry')->nullable()->after('card_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'ward',
                'district',
                'city',
                'postal_code',
                'country',
                'card_number',
                'card_expiry'
            ]);
        });
    }
};
