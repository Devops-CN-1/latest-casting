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
        Schema::create('expense_gold', function (Blueprint $table) {
            $table->id();
            $table->decimal('gold', 15, 3); // Stores gold value with decimal
            $table->text('remarks')->nullable(); // Optional remarks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_gold');
    }
};
