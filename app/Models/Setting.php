<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    
    use HasFactory;

    protected $fillable = [
        'site_title',
        'tagline',
        'logo_path',
        'favicon_path',

        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_search_console',
        'google_analytics',

        'slide_image_1_path',
        'slide_title_1',
        'slide_description_1',
        'slide_image_2_path',
        'slide_title_2',
        'slide_description_2',
        'slide_image_3_path',
        'slide_title_3',
        'slide_description_3',
        'slide_image_4_path',
        'slide_title_4',
        'slide_description_4',
        'slide_image_5_path',
        'slide_title_5',
        'slide_description_5',
        'slide_image_6_path',
        'slide_title_6',
        'slide_description_6',

        'link_name_1',
        'link_1',
        'link_name_2',
        'link_2',
        'link_name_3',
        'link_3',

        'facebook_url',
        'youtube_url',
        'twitter_url',
        'instagram_url',
        
        'email',
        'phone_no',
        'address',
    ];
}
