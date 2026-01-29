<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->integer('CommitteeYear_id');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->integer('role');
            $table->text('address')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('committee_members');
    }
};
