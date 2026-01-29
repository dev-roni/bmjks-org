<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideDataValidate5 extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "slide_title_5"        => "nullable|string|min:5|max:100",
            "slide_description_5"  => "nullable|string|min:10|max:250",
            "slide_image_5"        => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ];
    }

    public function messages(): array {
        return [
            "slide_title_5.min"         => "স্লাইডের শিরোনাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "slide_title_5.max"         => "স্লাইডের শিরোনাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "slide_description_5.min"   => "স্লাইডের বিবরণ কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "slide_description_5.max"   => "স্লাইডের বিবরণ সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "slide_image_5.image"       => "স্লাইড ছবি অবশ্যই একটি ছবি হতে হবে।",
            "slide_image_5.mimes"       => "স্লাইড ছবি কেবল JPG, JPEG অথবা PNG ফরম্যাটে হতে পারবে।",
            "slide_image_5.max"         => "স্লাইড ছবি সাইজ সর্বোচ্চ 2MB হতে পারবে।",
        ];
    }
}
