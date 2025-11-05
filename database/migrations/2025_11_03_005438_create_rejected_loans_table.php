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
        Schema::create('rejected_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->nullable()->constrained('loans')->onDelete('cascade');
            $table->foreignId('item_loan_id')->nullable()->constrained('item_loans')->onDelete('cascade');
            $table->string('loan_method')->default('Cash');
            $table->decimal('loan_type', 10, 2);
            $table->string('product_name')->nullable();
            
            // Member details
            $table->string('member_name');
            $table->string('member_enlisted_no');
            $table->string('member_regiment_no');
            $table->string('member_army_id');
            
            // Guarantor 1 details
            $table->string('guarantor1_name');
            $table->string('guarantor1_enlisted_no');
            $table->string('guarantor1_regiment_no');
            $table->string('guarantor1_army_id');
            
            // Guarantor 2 details
            $table->string('guarantor2_name');
            $table->string('guarantor2_enlisted_no');
            $table->string('guarantor2_regiment_no');
            $table->string('guarantor2_army_id');
            
            // Rejection details
            $table->text('rejection_reason');
            $table->foreignId('rejected_by')->constrained('users');
            $table->timestamp('rejected_at');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejected_loans');
    }
};
