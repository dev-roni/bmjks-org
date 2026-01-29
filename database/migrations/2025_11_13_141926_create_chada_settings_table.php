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
        Schema::create('chada_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('central_chada_amount')->default(2100);
            $table->integer('branch_chada_amount')->default(250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chada_settings');
    }
};
