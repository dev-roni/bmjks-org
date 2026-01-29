<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SEOValidate extends FormRequest {

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "meta_title"            => "nullable|string|min:10|max:250",
            "meta_description"      => "nullable|string|min:10|max:3000",
            "meta_keywords"         => "nullable|string|min:10|max:250",
            "google_search_console" => "nullable|string|min:5|max:100",
            "google_analytics"      => "nullable|string|min:5|max:100",
        ];
    }

    public function messages(): array{
        return [
            "meta_title.string"      => "মেটা শিরোনাম অবশ্যই টেক্সট আকারে হতে হবে।",
            "meta_title.min"         => "মেটা শিরোনাম কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "meta_title.max"         => "মেটা শিরোনাম সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "meta_description.string" => "মেটা বিবরণ অবশ্যই টেক্সট আকারে হতে হবে।",
            "meta_description.min"    => "মেটা বিবরণ কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "meta_description.max"    => "মেটা বিবরণ সর্বোচ্চ ৩০০০ অক্ষরের হতে পারবে।",

            "meta_keywords.string" => "মেটা কীওয়ার্ড অবশ্যই টেক্সট আকারে হতে হবে।",
            "meta_keywords.min"    => "মেটা কীওয়ার্ড কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "meta_keywords.max"    => "মেটা কীওয়ার্ড সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "google_search_console.string" => "Google Search Console কোড অবশ্যই টেক্সট আকারে হতে হবে।",
            "google_search_console.min"    => "Google Search Console কোড কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "google_search_console.max"    => "Google Search Console কোড সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "google_analytics.string" => "Google Analytics কোড অবশ্যই টেক্সট আকারে হতে হবে।",
            "google_analytics.min"    => "Google Analytics কোড কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "google_analytics.max"    => "Google Analytics কোড সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",
        ];
    }
}
