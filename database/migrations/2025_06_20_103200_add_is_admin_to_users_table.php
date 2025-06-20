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
    if (Schema::hasColumn('users', 'is_admin')) {
        // Column exists - modify it
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')
                  ->default(false)
                  ->nullable()
                  ->change();
        });
    } else {
        // Column doesn't exist - create it
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->nullable();
        });
    }
}
};
