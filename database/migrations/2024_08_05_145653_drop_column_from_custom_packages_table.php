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
            // Drop the 'description' column
            $table->dropColumn('description');

            // Modify the existing 'addon' column to be nullable
            $table->json('addons')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            // Add back the 'description' column with text type and make it nullable
            $table->text('description')->nullable();

            // Change the 'addon' column to be non-nullable again (if it was originally non-nullable)
            $table->json('addons')->nullable(false)->change();
        });
    }
};
