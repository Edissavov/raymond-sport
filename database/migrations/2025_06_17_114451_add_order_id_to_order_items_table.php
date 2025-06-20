<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First check if the column exists
        if (Schema::hasColumn('order_items', 'order_id')) {
            // Column exists - just add the foreign key constraint
            Schema::table('order_items', function (Blueprint $table) {
                // Ensure all records have valid order_id
                DB::table('order_items')
                    ->whereNull('order_id')
                    ->orWhereNotIn('order_id', DB::table('orders')->pluck('id'))
                    ->update(['order_id' => DB::table('orders')->value('id')]);

                // Add the foreign key constraint
                $table->foreign('order_id')
                      ->references('id')
                      ->on('orders')
                      ->onDelete('cascade');
            });
        } else {
            // Column doesn't exist - create it with constraint
            Schema::table('order_items', function (Blueprint $table) {
                $table->foreignId('order_id')
                      ->constrained()
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            // Don't drop column if it existed before migration
            if (!Schema::hasColumn('order_items', 'order_id')) {
                $table->dropColumn('order_id');
            }
        });
    }
};
