<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeActivitiesEdit extends FormRequest
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
        'title'=>'required|string|max:70|min:5',
        'description'=>'required|string|max:3000|min:5',
        'activities_date'=>'required|date'
        ];
    }
    public function messages(): array {
        return [
            "title.max"       => "টাইটেল সর্বোচ্চ ৭০ অক্ষর হতে পারবে।",
            "title.min"       => "টাইটেল সর্বনিম্ন ৫ অক্ষর হতে পারবে।",
            "title.string"       => "টাইটেল অক্ষরের হতে পারবে।",
            "title.required"       => "টাইটেল দিতে হবে।",

            "description.required" => "ডিস্ক্রিপশন দিতে হবে",
            "description.max" => "ডিস্ক্রিপশন সর্বোচ্চ ৩০০০ অক্ষর হতে পারবে।",
            "description.min" => "ডিস্ক্রিপশন সর্বনিম্ন ৫ অক্ষর হতে পারবে।",
            "description.string" => "ডিস্ক্রিপশন অক্ষরের হতে হবে",

            "activities_date.required"     => " তারিখ দিতে হবে ",
        ];
    }
}
