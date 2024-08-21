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
            $table->decimal('luggage')->after('vehicle');
            $table->decimal('price')->after('luggage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            $table->dropColumn('luggage');
            $table->dropColumn('price');
        });
    }
};
