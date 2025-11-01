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
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('approval_level')->default(0)->after('status');
            // 0 = pending (Welfare Clerk created)
            // 1 = Welfare OC approved
            // 2 = Shop Coord Clerk approved
            // 3 = Shop Coord OC approved (final)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('approval_level');
        });
    }
};
