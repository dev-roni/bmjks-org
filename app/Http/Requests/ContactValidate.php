<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactValidate extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'phone'   => ['required', 'string', 'max:11', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array {
        return [
            'name.required'    => 'অনুগ্রহ করে আপনার নাম লিখুন।',
            'name.string'      => 'নাম অবশ্যই টেক্সট আকারে হতে হবে।',
            'name.max'         => 'নাম সর্বোচ্চ ১০০ অক্ষর হতে পারবে।',

            'phone.required'   => 'মোবাইল নম্বর দেওয়া আবশ্যক।',
            'phone.string'     => 'মোবাইল নম্বর সঠিক ফরম্যাটে লিখুন।',
            'phone.max'        => 'মোবাইল নম্বর সর্বোচ্চ ১১ সংখ্যার হতে পারবে।',
            'phone.regex'      => 'বৈধ বাংলাদেশি মোবাইল নম্বর দিন (যেমন: 01XXXXXXXXX)।',

            'email.required'   => 'ইমেইল ঠিকানা দেওয়া আবশ্যক।',
            'email.email'      => 'বৈধ ইমেইল ঠিকানা দিন।',
            'email.max'        => 'ইমেইল সর্বোচ্চ ২৫৫ অক্ষর হতে পারবে।',

            'subject.required' => 'অনুগ্রহ করে বিষয় লিখুন।',
            'subject.string'   => 'বিষয় অবশ্যই টেক্সট আকারে হতে হবে।',
            'subject.max'      => 'বিষয় সর্বোচ্চ ২৫৫ অক্ষর হতে পারবে।',

            'message.required' => 'অনুগ্রহ করে বার্তা লিখুন।',
            'message.string'   => 'বার্তা অবশ্যই টেক্সট আকারে হতে হবে।',
            'message.min'      => 'বার্তা কমপক্ষে ১০ অক্ষরের হতে হবে।',
            'message.max'      => 'বার্তা সর্বোচ্চ ১০০০ অক্ষরের হতে পারবে।',
        ];
    }
}
