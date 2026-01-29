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
        Schema::create('party_regular', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partyID');
 
            $table->string('partyName', 150);
            $table->string('businessName', 150)->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 50)->nullable();
 
            // Order & Discounts
            $table->integer('totalOrders')->default(0);
 
            $table->decimal('wasteDiscount', 8, 2)->default(0);
            $table->decimal('mazdoriDiscount', 8, 2)->default(0);
            $table->decimal('wasteDiscount16', 8, 2)->default(0);
            $table->decimal('mazdooriDiscount16', 8, 2)->default(0);
 
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_regular');
    }
};
