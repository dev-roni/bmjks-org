<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceValidate extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "title"    => "required|string|min:5|max:250",
            "date"     => "required|date",
            "pdf_path" => "nullable|mimes:pdf|max:2048",
        ];
    }

    public function messages(): array {
        return [
            "title.required"    => "শিরোনাম অবশ্যই দিতে হবে।",
            "title.string"      => "শিরোনাম অবশ্যই টেক্সট আকারে হতে হবে।",
            "title.min"         => "শিরোনাম কমপক্ষে ৫ অক্ষরের হতে হবে।",
            "title.max"         => "শিরোনাম সর্বোচ্চ ২৫০ অক্ষরের হতে পারবে।",

            "date.required"     => "তারিখ অবশ্যই দিতে হবে।",
            "date.date"         => "তারিখ অবশ্যই সঠিক ফরম্যাটে হতে হবে।",

            "pdf_path.mimes"    => "শুধুমাত্র PDF ফাইল আপলোড করা যাবে।",
            "pdf_path.max"      => "পিডিএফ ফাইলের সাইজ সর্বোচ্চ ২MB হতে পারবে।",
        ];
    }
}
