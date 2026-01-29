<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:50',
            'relation_type'         => 'required|in:পিতা,স্বামী',
            'father_husband_name'   => 'required|string|max:50',
            'mother_name'           => 'required|string|max:50',
            'photo'                 => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date_of_birth'         => 'required|date',
            'gender'                => 'required|in:male,female,other',
            'caste'                 => 'nullable|string|max:100',
            'marital_status'        => 'required|in:single,married,divorced,widowed',
            'mobile_number'         => 'required|regex:/^01[0-9]{9}$/',
            'village'               => 'required|string|max:25',
            'post_office'           => 'required|string|max:25',
            'thana'                 => 'required|string|max:25',
            'district'              => 'required|string|max:25',
            'profession'            => 'nullable|string|max:25',
            'gm_id'                 => 'nullable|string|max:2',
            'blood_group'           => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'               => 'নাম অবশ্যই দিতে হবে।',
            'name.string'                 => 'নাম অবশ্যই টেক্সট হতে হবে।',
            'name.max'                    => 'নামের দৈর্ঘ্য সর্বোচ্চ ৫০ অক্ষর হতে পারবে।',

            'father_husband_name.required'=> 'পিতার/স্বামীর নাম দিতে হবে।',
            'father_husband_name.string'  => 'পিতার/স্বামীর নাম অবশ্যই টেক্সট হতে হবে।',
            'father_husband_name.max'     => 'পিতার/স্বামীর নাম সর্বোচ্চ ৫০ অক্ষর হতে পারবে।',

            'mother_name.required'        => 'মাতার নাম দিতে হবে।',
            'mother_name.string'          => 'মাতার নাম অবশ্যই টেক্সট হতে হবে।',
            'mother_name.max'             => 'মাতার নাম সর্বোচ্চ ৫০ অক্ষর হতে পারবে।',

            'photo.image'                 => 'ছবিটি অবশ্যই একটি ইমেজ হতে হবে।',
            'photo.mimes'                 => 'ছবি অবশ্যই jpg, jpeg অথবা png ফরম্যাটে হতে হবে।',
            'photo.max'                   => 'ছবির সাইজ সর্বোচ্চ ২MB হতে পারবে।',

            'date_of_birth.required'      => 'জন্মতারিখ অবশ্যই দিতে হবে।',
            'date_of_birth.date'          => 'জন্মতারিখ সঠিক ফরম্যাটে হতে হবে।',

            'gender.required'             => 'লিঙ্গ নির্বাচন করতে হবে।',
            'gender.in'                   => 'লিঙ্গ male, female অথবা other হতে হবে।',

            'caste.string'                => 'জাত অবশ্যই টেক্সট হতে হবে।',
            'caste.max'                   => 'জাত সর্বোচ্চ ১০০ অক্ষর হতে পারবে।',

            'marital_status.required'     => 'বৈবাহিক অবস্থা দিতে হবে।',
            'marital_status.in'           => 'বৈবাহিক অবস্থা single, married, divorced অথবা widowed হতে হবে।',

            'mobile_number.required'      => 'মোবাইল নম্বর অবশ্যই দিতে হবে।',
            'mobile_number.regex'         => 'সঠিক ফরম্যাটে মোবাইল নম্বর দিন (যেমন: 01XXXXXXXXX)।',

            'village.required'            => 'গ্রাম অবশ্যই দিতে হবে।',
            'village.string'              => 'গ্রাম অবশ্যই টেক্সট হতে হবে।',
            'village.max'                 => 'গ্রামের নাম সর্বোচ্চ ২৫ অক্ষর হতে পারবে।',

            'post_office.required'        => 'ডাকঘর অবশ্যই দিতে হবে।',
            'post_office.string'          => 'ডাকঘর অবশ্যই টেক্সট হতে হবে।',
            'post_office.max'             => 'ডাকঘরের নাম সর্বোচ্চ ২৫ অক্ষর হতে পারবে।',

            'thana.required'              => 'থানা অবশ্যই দিতে হবে।',
            'thana.string'                => 'থানা অবশ্যই টেক্সট হতে হবে।',
            'thana.max'                   => 'থানার নাম সর্বোচ্চ ২৫ অক্ষর হতে পারবে।',

            'district.required'           => 'জেলা অবশ্যই দিতে হবে।',
            'district.string'             => 'জেলা অবশ্যই টেক্সট হতে হবে।',
            'district.max'                => 'জেলার নাম সর্বোচ্চ ২৫ অক্ষর হতে পারবে।',

            'profession.string'           => 'পেশা অবশ্যই টেক্সট হতে হবে।',
            'profession.max'              => 'পেশার নাম সর্বোচ্চ ২৫ অক্ষর হতে পারবে।',

            'blood_group.in'              => 'সঠিক ব্লাড গ্রুপ নির্বাচন করুন (A+, A-, B+, B-, AB+, AB-, O+, O-)।',
        ];
    }

}
