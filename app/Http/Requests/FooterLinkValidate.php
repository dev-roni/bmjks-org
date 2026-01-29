<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterLinkValidate extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "link_name_1" => "nullable|string|min:5|max:100",
            "link_1"      => "nullable|url|max:255",
            
            "link_name_2" => "nullable|string|min:5|max:100",
            "link_2"      => "nullable|url|max:255",

            "link_name_3" => "nullable|string|min:5|max:100",
            "link_3"      => "nullable|url|max:255",
        ];
    }

    public function messages(): array {
        return [
            "link_name_1.min"     => "লিঙ্কের নাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "link_name_1.max"     => "লিঙ্কের নাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "link_1.url"          => "লিঙ্কের ঠিকানা সঠিক URL ফরম্যাটে হতে হবে।",
            "link_1.max"          => "লিঙ্কের ঠিকানা সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।",

            "link_name_2.min"     => "লিঙ্কের নাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "link_name_2.max"     => "লিঙ্কের নাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "link_2.url"          => "লিঙ্কের ঠিকানা সঠিক URL ফরম্যাটে হতে হবে।",
            "link_2.max"          => "লিঙ্কের ঠিকানা সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।",

            "link_name_3.min"     => "লিঙ্কের নাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "link_name_3.max"     => "লিঙ্কের নাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "link_3.url"          => "লিঙ্কের ঠিকানা সঠিক URL ফরম্যাটে হতে হবে।",
            "link_3.max"          => "লিঙ্কের ঠিকানা সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।",
        ];
    }
}
