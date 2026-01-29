<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideDataValidate3 extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "slide_title_3"        => "nullable|string|min:5|max:100",
            "slide_description_3"  => "nullable|string|min:10|max:250",
            "slide_image_3"        => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ];
    }

    public function messages(): array {
        return [
            "slide_title_3.min"         => "স্লাইডের শিরোনাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "slide_title_3.max"         => "স্লাইডের শিরোনাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "slide_description_3.min"   => "স্লাইডের বিবরণ কমপক্ষে ১০ অক্ষরের হতে হবে।",
            "slide_description_3.max"   => "স্লাইডের বিবরণ সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "slide_image_3.image"       => "স্লাইড ছবি অবশ্যই একটি ছবি হতে হবে।",
            "slide_image_3.mimes"       => "স্লাইড ছবি কেবল JPG, JPEG অথবা PNG ফরম্যাটে হতে পারবে।",
            "slide_image_3.max"         => "স্লাইড ছবি সাইজ সর্বোচ্চ 2MB হতে পারবে।",
        ];
    }
}
