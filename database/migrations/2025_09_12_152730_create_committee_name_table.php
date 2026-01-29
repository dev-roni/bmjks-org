<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('committee_names', function (Blueprint $table) {
            $table->id();
            $table->string('committee_name');
            $table->string('committee_slug');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('committee_name');
    }
};
