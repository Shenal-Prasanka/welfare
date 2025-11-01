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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique(); // Auto-generated LN-XXXXX
            
            // Member Details
            $table->enum('loan_type', ['100000', '300000']);
            $table->string('enlisted_no');
            $table->string('regiment_no');
            $table->string('rank');
            $table->string('name');
            $table->string('nic');
            $table->string('army_id');
            $table->text('office_address');
            $table->string('previous_unit')->nullable();
            $table->enum('welfare_membership', ['Yes', 'No']);
            $table->date('welfare_membership_date')->nullable();
            $table->string('bill_no')->nullable();
            $table->date('bill_date')->nullable();
            $table->date('enlisted_date');
            $table->date('retire_date')->nullable();
            $table->enum('paying_installments', ['Yes', 'No']);
            $table->string('bank_name');
            $table->string('branch');
            $table->string('account_no');
            $table->string('mobile_no');
            $table->string('land_no')->nullable();
            $table->boolean('consent_agreement')->default(false);
            $table->string('soldier_statement')->nullable(); // File path
            
            // Guarantor 1 Details
            $table->string('guarantor1_enlisted_no');
            $table->string('guarantor1_regiment_no');
            $table->string('guarantor1_rank');
            $table->string('guarantor1_name');
            $table->string('guarantor1_nic');
            $table->string('guarantor1_army_id');
            $table->text('guarantor1_office_address');
            $table->string('guarantor1_previous_unit')->nullable();
            $table->enum('guarantor1_welfare_membership', ['Yes', 'No']);
            $table->date('guarantor1_enlisted_date');
            $table->date('guarantor1_retire_date')->nullable();
            
            // Guarantor 2 Details
            $table->string('guarantor2_enlisted_no');
            $table->string('guarantor2_regiment_no');
            $table->string('guarantor2_rank');
            $table->string('guarantor2_name');
            $table->string('guarantor2_nic');
            $table->string('guarantor2_army_id');
            $table->text('guarantor2_office_address');
            $table->string('guarantor2_previous_unit')->nullable();
            $table->enum('guarantor2_welfare_membership', ['Yes', 'No']);
            $table->date('guarantor2_enlisted_date');
            $table->date('guarantor2_retire_date')->nullable();
            
            // Approval workflow
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('created_by'); // Loan Clerk
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable(); // Loan OC
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('rejected_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
