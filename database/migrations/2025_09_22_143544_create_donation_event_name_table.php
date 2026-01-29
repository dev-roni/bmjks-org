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
        Schema::create('donation_event_name', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('description');
            $table->enum('status',['active','deactive'])->default('active');
            $table->string('total_amount')->nullable();
            $table->string('total_donator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_event_name');
    }
};
