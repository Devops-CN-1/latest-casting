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
        Schema::create('parties', function (Blueprint $table) {
            $table->id('partyID'); // Primary Key
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('type', 100)->nullable(); // e.g. customer, supplier, regular, etc.
            $table->boolean('IsActive')->default(1); // 0 for oper 1 for ander
            $table->decimal('goldIn', 15, 3)->default(0);
            $table->decimal('goldOut', 15, 3)->default(0);
            $table->decimal('cashIn', 15, 2)->default(0);
            $table->decimal('cashOut', 15, 2)->default(0);
            $table->decimal('totalWasteCasted', 15, 3)->default(0);
            $table->decimal('totalMazdoori', 15, 2)->default(0);
            $table->date('lastOrderDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
