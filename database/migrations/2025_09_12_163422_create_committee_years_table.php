<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('committee_years', function (Blueprint $table) {
            $table->id();
            $table->integer('committee_id');
            $table->string('committee_name');
            $table->date('committee_start_date');
            $table->date('committee_end_date')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('committee_years');
    }
};
