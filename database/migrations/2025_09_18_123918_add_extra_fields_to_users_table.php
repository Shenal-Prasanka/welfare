<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nic')->nullable()->unique()->after('profile_image');
            $table->string('armyId')->nullable()->unique()->after('nic');
            $table->string('officeAddress')->nullable()->after('armyId');
            $table->date('enlistedDate')->nullable()->after('officeAddress'); 
            $table->date('retireDate')->nullable()->after('enlistedDate'); 
            $table->unsignedBigInteger('welfare_id')->nullable()->after('retireDate');
            $table->string('role')->nullable()->after('welfare_id'); 
        });

    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nic', 'armyId', 'officeAddress', 'enlistedDate', 'retireDate']);
            $table->dropForeign(['welfare_id']);
            $table->dropColumn('welfare_id');
        });
    }
};

