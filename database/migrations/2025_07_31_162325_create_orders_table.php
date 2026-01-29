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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('created_by');
        // Step 2: Add the foreign key
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('weightReady', 16, 3)->nullable();
            $table->decimal('mailCode');
            $table->decimal('mazdoriRate', 16, 3)->default(0);
            $table->decimal('wasteRate', 16, 3);
            $table->decimal('tollaRate', 16, 3)->nullable();
            $table->decimal('goldIN', 16, 3)->default(0);
            $table->decimal('goldOut', 16, 3)->default(0);
            $table->decimal('cashIn', 16, 3)->default(0);
            $table->decimal('cashOut', 16, 3)->default(0);
            $table->decimal('wasteCasted', 16, 3)->nullable();
            $table->decimal('mazdoorie', 16, 3)->default(0);
            $table->boolean('InOutCheck')->default(0); // 0 for oper 1 for ander
            $table->decimal('InOut', 16, 3)->nullable();
            $table->boolean('Piece')->default(0); // 0 for pathoor 1 for piece
            $table->text('remarks')->nullable();
            $table->enum('selectOption', ['op1', 'op2', 'op3'])->nullable()->default('op1');
            $table->decimal('totalGold', 16, 3)->nullable()->default(0);
            $table->decimal('totalMazdoori', 16, 3)->nullable()->default(0);
            $table->decimal('totalMazdooriInGold', 16, 3)->nullable()->default(0);
            $table->decimal('totalMazdooriInCash', 16, 3)->nullable()->default(0);
            $table->decimal('goldInAfter', 16, 3)->nullable()->default(0);
            $table->decimal('goldOutAfter', 16, 3)->nullable()->default(0);
            $table->decimal('cashInAfter', 16, 3)->nullable()->default(0);
            $table->decimal('cashOutAfter', 16, 3)->nullable()->default(0);

            // Option 1
            $table->decimal('op1GoldRecieved', 16, 3)->nullable()->default(0);
            $table->decimal('op1MazdooriRecieved', 16, 3)->nullable()->default(0);
            $table->decimal('op1GoldPaid', 16, 3)->nullable()->default(0);
            $table->decimal('op1MazdooriPaid', 16, 3)->nullable()->default(0);
            $table->decimal('op1RemainingGold', 16, 3)->nullable()->default(0);
            $table->decimal('op1RemainingCash', 16, 3)->nullable()->default(0);

            // Option 2
            $table->decimal('op2GoldRecieved', 16, 3)->nullable()->default(0);
            $table->decimal('op2GoldPaid', 16, 3)->nullable()->default(0);
            $table->decimal('op2RemainingGold', 16, 3)->nullable()->default(0);
            $table->decimal('op2CashRecieved', 16, 3)->nullable()->default(0);
            $table->decimal('op2CashPaid', 16, 3)->nullable()->default(0);
            $table->decimal('op2RemainingCash', 16, 3)->nullable()->default(0);

            // Option 3
            $table->decimal('op3CashRecieved', 16, 3)->nullable()->default(0);
            $table->decimal('op3CashPaid', 16, 3)->nullable()->default(0);
            $table->decimal('op3RemainingCash', 16, 3)->nullable()->default(0);

            // Weights & extra info
            $table->decimal('totalWeight', 16, 3)->nullable();
            $table->decimal('totalWeightCasted', 16, 3)->nullable();
            $table->decimal('khalis', 16, 3)->nullable();
            $table->decimal('advance', 16, 3)->nullable()->default(0);
            $table->decimal('totalKhalis', 16, 3)->nullable();
            $table->decimal('remainingMazdoori', 16, 3)->nullable()->default(0);
            $table->decimal('wapsiGold', 16, 3)->nullable()->default(0);
            $table->decimal('castingWeight', 16, 3)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
