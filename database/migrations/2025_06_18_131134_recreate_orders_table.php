<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Disable foreign key checks temporarily
        Schema::disableForeignKeyConstraints();

        // 1. First drop the foreign key constraint from order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        // 2. Now drop the orders table
        Schema::dropIfExists('orders');

        // 3. Recreate the orders table with all required fields and defaults
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->text('shipping_address');
            $table->string('delivery_option')->default('econt'); // With default value
            $table->string('phone_number');
            $table->text('notes')->nullable();
            $table->string('payment_method')->default('cash_on_delivery');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        // 4. Recreate the foreign key constraint
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade'); // Cascade deletes from orders to order_items
        });

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('orders');

        // Optionally: Recreate the original orders table structure here
        // if you need the down() migration to be perfectly reversible

        Schema::enableForeignKeyConstraints();
    }
};