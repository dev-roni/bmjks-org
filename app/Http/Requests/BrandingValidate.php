<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandingValidate extends FormRequest {

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        return [
            "site_title" => "nullable|string|min:5|max:100",
            "tagline"    => "nullable|string|min:10|max:250",
            "logo"       => "nullable|image|mimes:jpg,jpeg,png|max:2048",
            "favicon"    => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ];
    }

    public function messages(): array {
        return [
            "site_title.string"   => "সাইটের শিরোনাম টেক্সট আকারে হতে হবে।",
            "site_title.min"      => "সাইটের শিরোনাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "site_title.max"      => "সাইটের শিরোনাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "tagline.string"      => "ট্যাগলাইন টেক্সট আকারে হতে হবে।",
            "tagline.min"         => "ট্যাগলাইন কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "tagline.max"         => "ট্যাগলাইন সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "logo.image"          => "লোগো অবশ্যই একটি ছবি হতে হবে।",
            "logo.mimes"          => "লোগো কেবল JPG, JPEG অথবা PNG ফরম্যাটে হতে পারবে।",
            "logo.max"            => "লোগোর সাইজ সর্বোচ্চ 2MB হতে পারবে।",

            "favicon.image"       => "ফ্যাভিকন অবশ্যই একটি ছবি হতে হবে।",
            "favicon.mimes"       => "ফ্যাভিকন কেবল JPG, JPEG অথবা PNG ফরম্যাটে হতে পারবে।",
            "favicon.max"         => "ফ্যাভিকনের সাইজ সর্বোচ্চ 2MB হতে পারবে।",
        ];
    }
}
