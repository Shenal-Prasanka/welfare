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
        Schema::create('purchaseorders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('welfare');
            $table->string('supply_id');
            $table->string('supplier_code');
            // Store arrays as JSON
            $table->json('items');          // item names
            $table->json('models');         // model values
            $table->json('quantities');     // qty
            $table->json('welfare_price');  // welfare_price per item
            $table->json('welfare_total');  // welfare_total per item
            $table->json('mrp');            // mrp per item
            $table->json('mrp_total');      // mrp_total per item
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('purchaseorders', function (Blueprint $table) {
            $table->dropForeign(['supply_id']);
            $table->dropColumn('supply_id');


        });
    }
};
