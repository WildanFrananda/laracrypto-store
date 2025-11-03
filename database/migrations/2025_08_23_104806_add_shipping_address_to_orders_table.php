<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_recipient_name')->after('status');
            $table->string('shipping_phone_number')->after('shipping_recipient_name');
            $table->text('shipping_full_address')->after('shipping_phone_number');
            $table->string('shipping_city')->after('shipping_full_address');
            $table->string('shipping_province')->after('shipping_city');
            $table->string('shipping_postal_code')->after('shipping_province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_recipient_name',
                'shipping_phone_number',
                'shipping_full_address',
                'shipping_city',
                'shipping_province',
                'shipping_postal_code',
            ]);
        });
    }
};
