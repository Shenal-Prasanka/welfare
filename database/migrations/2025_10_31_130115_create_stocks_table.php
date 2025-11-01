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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('purchase_order_item_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('welfare_id');
            $table->string('item_name');
            $table->string('item_model')->nullable();
            $table->string('item_code')->nullable(); // Product code from products table
            $table->string('item_category')->nullable(); // Category from products table
            $table->decimal('item_normal_price', 12, 2)->default(0);
            $table->decimal('item_welfare_price', 12, 2)->default(0);
            $table->string('serial_number')->unique();
            $table->string('status')->default('available'); // available, sold, damaged, etc.
            $table->timestamps();
            
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->cascadeOnDelete();
            $table->foreign('purchase_order_item_id')->references('id')->on('purchase_order_items')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->foreign('welfare_id')->references('id')->on('welfares')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
