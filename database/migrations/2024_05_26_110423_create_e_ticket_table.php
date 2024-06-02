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
        Schema::create('attraction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_details_id')->constrained('package_details')->onDelete('cascade');
            $table->string('attraction_name');
            $table->string('description');
            $table->date('visit_date');
            $table->integer('entry_fee');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attraction_details');
    }
};
