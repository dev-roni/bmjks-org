<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesDataValidate extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'icon'        => 'required',
            'title'       => 'required|string|min:5|max:250',
            'description' => 'required|string|min:10|max:3000',
        ];
    }

    public function messages(): array {
        return [
            'icon.required'        => 'অনুগ্রহ করে একটি Font Awesome আইকন ট্যাগ প্রদান করুন।',
            'icon.string'          => 'আইকন অবশ্যই একটি স্ট্রিং আকারে হতে হবে।',
            'icon.regex'           => 'অনুগ্রহ করে একটি বৈধ Font Awesome আইকন ট্যাগ প্রদান করুন।',

            'title.required'       => 'অনুগ্রহ করে শিরোনাম প্রদান করুন।',
            'title.string'         => 'শিরোনাম অবশ্যই একটি স্ট্রিং আকারে হতে হবে।',
            'title.min'            => 'শিরোনাম কমপক্ষে ৫টি অক্ষর হতে হবে।',
            'title.max'            => 'শিরোনাম সর্বোচ্চ ২৫০টি অক্ষর হতে পারে।',

            'description.required' => 'অনুগ্রহ করে বর্ণনা প্রদান করুন।',
            'description.string'   => 'বর্ণনা অবশ্যই একটি স্ট্রিং আকারে হতে হবে।',
            'description.min'      => 'বর্ণনা কমপক্ষে ১০টি অক্ষর হতে হবে।',
            'description.max'      => 'বর্ণনা সর্বোচ্চ ৩০০০টি অক্ষর হতে পারে।',
        ];
    }
}
