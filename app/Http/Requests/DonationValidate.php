<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'people_id'     => 'required|exists:people,mobile_number',   // লোকটি অবশ্যই people টেবিলে থাকতে হবে
            'event_id'      => 'required|exists:donation_event_name,id', // ইভেন্টটি অবশ্যই donation_events টেবিলে থাকতে হবে
            'donate_amount' => 'required|numeric|min:1|max_digits:8',      // কমপক্ষে ১ টাকা হতে হবে
            'date'          => 'required|date'
        ];
    }
    public function messages(): array{
        return [
            'people_id.required'     => 'সহায়তাকারীর মোবাইল নং দিতে হবে।',
            'people_id.exists'       => 'নির্বাচিত মোবাইল নং দিয়ে কোন ব্যাক্তি পাওয়া যায় নি । দয়া করে ব্যাক্তিটির একাউন্ট তৈরি করুন।',

            'event_id.required'      => 'ইভেন্ট নির্বাচন করতে হবে।',
            'event_id.exists'        => 'নির্বাচিত ইভেন্ট সিস্টেমে পাওয়া যায়নি।',

            'donate_amount.required' => 'ডোনেশনের পরিমাণ দিতে হবে।',
            'donate_amount.numeric'  => 'ডোনেশনের পরিমাণ অবশ্যই সংখ্যায় হতে হবে।',
            'donate_amount.min'      => 'ডোনেশনের পরিমাণ ন্যূনতম ১ টাকা হতে হবে।',
            'donate_amount.max'      => 'ডোনেশনের পরিমাণ সর্বোচ্চ ১ কোটি টাকা হতে পারবে',

            'date.required'          => 'তারিখ নির্বাচন করতে হবে।',
            'date.date'              => 'তারিখটি সঠিক নয়।',
            'date.before_or_equal'   => 'তারিখ আজকের তারিখ বা পূর্বের হতে হবে।',
        ];
    }
}
