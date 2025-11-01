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
        Schema::table('item_loans', function (Blueprint $table) {
            // Change status enum to include new statuses
            $table->enum('status', ['pending', 'oc_approved', 'approved', 'rejected'])->default('pending')->change();
            
            // Add Shop Coord Clerk approval fields
            $table->unsignedBigInteger('shop_coord_approved_by')->nullable()->after('approved_by');
            $table->timestamp('shop_coord_approved_at')->nullable()->after('approved_at');
            $table->boolean('loan_checked')->default(false)->after('shop_coord_approved_at');
            $table->boolean('membership_checked')->default(false)->after('loan_checked');
            
            // Add foreign key for shop coord clerk
            $table->foreign('shop_coord_approved_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_loans', function (Blueprint $table) {
            $table->dropForeign(['shop_coord_approved_by']);
            $table->dropColumn(['shop_coord_approved_by', 'shop_coord_approved_at', 'loan_checked', 'membership_checked']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};
