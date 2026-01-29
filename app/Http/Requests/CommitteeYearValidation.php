<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeYearValidation extends FormRequest
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
            "committee_id"          => "required|digits_between:1,13",
            "committee_year_name"   => "required|max:100",
            "start_date"            => "required|date"
        ];
    }
    public function messages(): array
    {
        return [
            "committee_id.required"        => "কমিটি নির্বাচন করতে হবে।",
            "committee_id.digits_between"  => "কমিটি আইডি ১ থেকে ১৩ সংখ্যার মধ্যে হতে হবে।",

            "committee_year_name.required" => "কমিটির নাম অবশ্যই দিতে হবে।",
            "committee_year_name.max"      => "কমিটির নাম সর্বোচ্চ ১০০ অক্ষরের হতে পারবে।",

            "start_date.required"          => "কমিটির দায়িত্ব গ্রহণের তারিখ অবশ্যই দিতে হবে।",
            "start_date.date"              => "শুরুর তারিখ অবশ্যই সঠিক তারিখ হতে হবে।",
        ];
    }

}
