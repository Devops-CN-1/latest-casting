<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('gold_rate', 10, 2)->nullable();   // gold price
            $table->decimal('gram_rate', 10, 3)->nullable();   // rate per gram
            $table->string('software_name')->nullable();       // software name
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};

