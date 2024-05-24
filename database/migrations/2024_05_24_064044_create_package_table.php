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
            $table->foreignId('package_flight_id')->nullable()->constrained('package_flight');
            $table->foreignId('package_hotel_id')->nullable()->constrained('package_hotel');
            $table->foreignId('package_attraction_id')->nullable()->constrained('package_attraction');
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
