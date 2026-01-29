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
        Schema::create('waste_to_mazdoori', function (Blueprint $table) {
            $table->id(); // Auto Primary Key (id)
 
            $table->decimal('waste', 10, 3)->default(0);   // waste in grams/tolla etc.
            $table->decimal('tolla', 10, 3)->default(0);   // tolla value
            $table->decimal('mazdori', 10, 2)->default(0); // mazdori (labour charges)
 
            $table->string('serial', 100)->nullable();     // serial number
            $table->string('password', 100)->nullable();   // password (can hash if sensitive)
            $table->string('machineCode', 100)->nullable(); // machine code
 
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_to_mazdoori');
    }
};