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
        Schema::create('package_details', function (Blueprint $table) {
            $table->id()->constrained();
            $table->foreignId('package_id')->constrained('package')->unsigned();
            $table->string('description');
            $table->string('origin_city');
            $table->string('destination_city');
            $table->date('departure_date');
            $table->date('return_date');
            $table->integer('number_of_people');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};