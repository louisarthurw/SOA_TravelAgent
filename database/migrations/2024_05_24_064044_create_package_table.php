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
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_agent_id')->constrained('travel_agent')->onDelete('cascade');
            $table->foreignId('flight_id')->nullable()->constrained('hotel_reservation')->onDelete('cascade');
            $table->foreignId('hotel_id')->nullable()->constrained('ticket')->onDelete('cascade');
            $table->foreignId('attraction_id')->nullable()->constrained('e_ticket')->onDelete('cascade');
            $table->integer('price');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package');
    }
};
