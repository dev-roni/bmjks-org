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
        Schema::create('chada_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('chada_names_id');
            $table->integer('committee_id');
            $table->integer('amount');
            $table->date('payment_date')->nullable();
            $table->enum('payment_status',['not_paid','paid','pending'])->default('not_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chada_collections');
    }
};
