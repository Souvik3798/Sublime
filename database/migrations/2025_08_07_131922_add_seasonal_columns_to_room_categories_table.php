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
        Schema::table('room_categories', function (Blueprint $table) {
            $table->string('cp_seasonal')->nullable()->after('cp');
            $table->string('ap_seasonal')->nullable()->after('ap');
            $table->string('map_seasonal')->nullable()->after('map');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_categories', function (Blueprint $table) {
            $table->dropColumn(['cp_seasonal', 'ap_seasonal', 'map_seasonal']);
        });
    }
};
