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
        Schema::create('stock_gold', function (Blueprint $table) {
            $table->id();
            $table->decimal('gold', 15, 3); // Assuming gold value in grams with precision
            $table->string('status')->nullable(); // You can change this to enum if needed
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_gold');
    }
};
