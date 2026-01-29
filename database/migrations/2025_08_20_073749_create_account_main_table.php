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
        Schema::create('account_main', function (Blueprint $table) {
            $table->id(); // ID (Primary Key)
            $table->unsignedBigInteger('partyID');

            $table->decimal('recievedGoldLast', 15, 3)->default(0);
            $table->decimal('paidGoldLast', 15, 3)->default(0);
            $table->decimal('recievedCashLast', 15, 2)->default(0);
            $table->decimal('paidCashLast', 15, 2)->default(0);

            $table->decimal('goldRate', 15, 2)->default(0);
            $table->decimal('gold', 15, 3)->default(0);
            $table->string('goldStatus', 50)->nullable();

            $table->decimal('cash', 15, 2)->default(0);
            $table->string('cashStatus', 50)->nullable();

            $table->string('hawala', 50)->default(0);
            $table->decimal('addGold', 15, 3)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_main');
    }
};
