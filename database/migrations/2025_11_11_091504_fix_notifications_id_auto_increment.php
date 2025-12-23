<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the id column to be auto-increment
        DB::statement('ALTER TABLE notifications MODIFY COLUMN id BIGINT UNSIGNED AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove auto-increment
        DB::statement('ALTER TABLE notifications MODIFY COLUMN id BIGINT UNSIGNED');
    }
};
