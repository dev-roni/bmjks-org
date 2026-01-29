<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeValidate extends FormRequest
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
            'title'      => 'required|string|max:200|min:5',
            'description'=> 'required|string|max:3000|min:5',
            'date'       => 'required|date',
        ];
    }
    
    public function messages():array{
        return[
            'title.required' => 'টাইটেল দিতে হবে',
            'title.string' => 'টাইটেল অক্ষরের দিতে হবে',
            'title.max' => 'টাইটেল ২০০ অক্ষরের কম দিতে হবে',
            'title.min' => 'টাইটেল ৫ অক্ষরের বেশি দিতে হবে',

            'description.required' => 'ডিসক্রিপশন দিতে হবে',
            'description.string' => 'ডিসক্রিপশন অক্ষরের দিতে হবে',
            'description.max' => 'ডিসক্রিপশন ২০০ অক্ষরের কম দিতে হবে',
            'description.min' => 'ডিসক্রিপশন ৫ অক্ষরের বেশি দিতে হবে',

            'date.required' => 'ডেট দিতে হবে',
            'date.date' => 'ডেট দিতে হবে'
        ];
    }
}
