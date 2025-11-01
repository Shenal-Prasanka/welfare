<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->string('item_name');
            $table->string('model_no')->nullable();
            $table->integer('qty');
            $table->decimal('welfare_price', 12, 2)->default(0);
            $table->decimal('welfare_net_value', 14, 2)->default(0);
            $table->decimal('mrp', 12, 2)->default(0);
            $table->decimal('mrp_net_value', 14, 2)->default(0);
            $table->timestamps();

            $table->foreign('purchase_order_id')
                ->references('id')
                ->on('purchase_orders')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};


