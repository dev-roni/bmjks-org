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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('google_search_console')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('slide_image_1_path')->nullable();
            $table->string('slide_title_1')->nullable();
            $table->text('slide_description_1')->nullable();
            $table->string('slide_image_2_path')->nullable();
            $table->string('slide_title_2')->nullable();
            $table->text('slide_description_2')->nullable();
            $table->string('slide_image_3_path')->nullable();
            $table->string('slide_title_3')->nullable();
            $table->text('slide_description_3')->nullable();
            $table->string('slide_image_4_path')->nullable();
            $table->string('slide_title_4')->nullable();
            $table->text('slide_description_4')->nullable();
            $table->string('slide_image_5_path')->nullable();
            $table->string('slide_title_5')->nullable();
            $table->text('slide_description_5')->nullable();
            $table->string('slide_image_6_path')->nullable();
            $table->string('slide_title_6')->nullable();
            $table->text('slide_description_6')->nullable();
            $table->string('link_name_1')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_name_2')->nullable();
            $table->string('link_2')->nullable();
            $table->string('link_name_3')->nullable();
            $table->string('link_3')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
