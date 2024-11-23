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
            $table->json('water_sports')->nullable()->after('addons'); // Add the column after 'addons'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            //
        });
    }
};
