<?php

use App\Models\User;
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
        Schema::create('water_sports_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Activity name
            $table->text('description')->nullable(); // Description of the activity
            $table->decimal('adult_price', 10, 2); // Price for adults
            $table->decimal('child_5_12_price', 10, 2); // Price for 5-12 years
            $table->decimal('child_2_5_price', 10, 2); // Price for 2-5 years
            $table->decimal('infant_price', 10, 2)->nullable(); // Price for infants (optional)
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_sports_activities');
    }
};
