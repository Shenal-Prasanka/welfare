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
        Schema::create('approved_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->unsignedBigInteger('item_loan_id')->nullable();
            $table->string('loan_method')->default('Cash');
            $table->decimal('loan_type', 10, 2);
            $table->string('deduct_time_period');
            $table->decimal('interest_percentage', 5, 2);
            $table->decimal('interest_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('monthly_amount', 10, 2);
            
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
            
            // Deductions (JSON to store month-by-month deductions)
            $table->json('deductions')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approved_loans');
    }
};
