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
        Schema::create('account_history_gold', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('party_id');
            $table->decimal('gold', 15, 3); // assuming gold in grams
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_history_gold');
    }
};
