<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressValidate extends FormRequest{

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "email"    => "nullable|max:250",
            "phone_no" => "nullable",
            "address"  => "nullable|max:3000",
        ];
    }

    public function messages(): array {
        return [
            "email.max"       => "ইমেইল সর্বোচ্চ ২৫০ অক্ষর হতে পারবে।",

            "phone_no.digits" => "মোবাইল নম্বর অবশ্যই ১১ সংখ্যার হতে হবে।",
            "phone_no.unique" => "এই মোবাইল নম্বরটি ইতিমধ্যে ব্যবহার করা হয়েছে।",

            "address.max"     => "ঠিকানা সর্বোচ্চ ৩০০০ অক্ষর হতে পারবে।",
        ];
    }
}
