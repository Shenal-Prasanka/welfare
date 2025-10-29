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
        Schema::create('regements', function (Blueprint $table) {
            $table->id();
            $table->string('regement')->unique(); // Regement column with unique constraint
            $table->boolean('active')->default(1); // Active column with default value 1 (1 = active, 0 = inactive)
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regement');
    }
};
