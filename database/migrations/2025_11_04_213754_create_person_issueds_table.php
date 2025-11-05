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
        Schema::create('person_issueds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_loan_id')->nullable();
            $table->unsignedBigInteger('approved_loan_id')->nullable();
            $table->unsignedBigInteger('stock_id')->nullable();
            
            // Member details
            $table->string('member_enlisted_no');
            $table->date('member_enlisted_date')->nullable();
            $table->string('member_name');
            $table->string('member_rank');
            $table->string('member_regiment_no');
            $table->string('member_nic');
            $table->string('member_army_id');
            $table->string('member_previous_unit')->nullable();
            
            // Guarantor 1 details
            $table->string('guarantor1_enlisted_no');
            $table->date('guarantor1_enlisted_date')->nullable();
            $table->string('guarantor1_name');
            $table->string('guarantor1_rank');
            $table->string('guarantor1_regiment_no');
            $table->string('guarantor1_nic');
            $table->string('guarantor1_army_id');
            $table->string('guarantor1_previous_unit')->nullable();
            
            // Guarantor 2 details
            $table->string('guarantor2_enlisted_no');
            $table->date('guarantor2_enlisted_date')->nullable();
            $table->string('guarantor2_name');
            $table->string('guarantor2_rank');
            $table->string('guarantor2_regiment_no');
            $table->string('guarantor2_nic');
            $table->string('guarantor2_army_id');
            $table->string('guarantor2_previous_unit')->nullable();
            
            // Item details
            $table->string('item_code');
            $table->string('item_name');
            $table->string('item_model')->nullable();
            $table->string('serial_number');
            $table->string('category')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('item_loan_id')->references('id')->on('item_loans')->onDelete('cascade');
            $table->foreign('approved_loan_id')->references('id')->on('approved_loans')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_issueds');
    }
};
