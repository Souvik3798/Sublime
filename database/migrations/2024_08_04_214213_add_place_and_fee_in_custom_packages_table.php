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
        Schema::table('custom_packages', function (Blueprint $table) {
            $table->json('place')->after('vehicle');
            $table->integer('fee')->after('place');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            $table->dropColumn('place');
            $table->dropColumn('fee');
        });
    }
};
