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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_option')->after('shipping_address');
            $table->string('phone_number')->after('delivery_option');
            $table->text('notes')->nullable()->after('phone_number');
            $table->string('payment_method')->default('cash_on_delivery')->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_option', 'phone_number', 'notes', 'payment_method']);
        });
    }
};
