<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaValidate extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "facebook_url" => "nullable|url|max:250",
            "youtube_url" => "nullable|url|max:250",
            "twitter_url" => "nullable|url|max:250",
            "instagram_url" => "nullable|url|max:250",
        ];
    }

    public function messages(): array {
        return [
            "facebook_url.url" => "ফেসবুক লিঙ্ক অবশ্যই একটি বৈধ URL হতে হবে।",
            "facebook_url.max" => "ফেসবুক লিঙ্ক সর্বোচ্চ ২৫০ অক্ষর হতে পারবে।",

            "youtube_url.url" => "ইউটিউব লিঙ্ক অবশ্যই একটি বৈধ URL হতে হবে।",
            "youtube_url.max" => "ইউটিউব লিঙ্ক সর্বোচ্চ ২৫০ অক্ষর হতে পারবে।",

            "twitter_url.url" => "টুইটার লিঙ্ক অবশ্যই একটি বৈধ URL হতে হবে।",
            "twitter_url.max" => "টুইটার লিঙ্ক সর্বোচ্চ ২৫০ অক্ষর হতে পারবে।",

            "instagram_url.url" => "ইনস্টাগ্রাম লিঙ্ক অবশ্যই একটি বৈধ URL হতে হবে।",
            "instagram_url.max" => "ইনস্টাগ্রাম লিঙ্ক সর্বোচ্চ ২৫০ অক্ষর হতে পারবে।",
        ];
    }
}
