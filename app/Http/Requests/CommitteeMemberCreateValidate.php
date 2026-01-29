<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommitteeMemberCreateValidate extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {

        $roleRules = [
            'required',
            'integer',
            'in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16',
        ];

        if ($this->role != 16) {
            $roleRules[] = Rule::unique('committee_members')
                ->where(function ($query) {
                    return $query->where('CommitteeYear_id', $this->CommitteeYear_id);
                });
        }

        return [
            'CommitteeYear_id' => 'required|integer',
            'name'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role'  => $roleRules,
            'address'  => 'required|string|max:500',
            'mobile'   => 'required|regex:/^01[0-9]{9}$/',
            'email'    => 'required|email|max:255',
            'facebook' => 'required|url|max:255',
        ];
    }

    public function messages(): array {
        return [
            'CommitteeYear_id.required' => 'কমিটি বছরের তথ্য অবশ্যই প্রদান করতে হবে।',
            'CommitteeYear_id.integer'  => 'কমিটি বছরের তথ্য সংখ্যা আকারে হতে হবে।',

            'name.required' => 'সদস্যের নাম অবশ্যই প্রদান করতে হবে।',
            'name.string'   => 'সদস্যের নাম সঠিক আকারে লিখতে হবে।',
            'name.max'      => 'সদস্যের নাম সর্বাধিক ২৫৫ অক্ষরের হতে পারে।',

            'photo.image' => 'আপলোড করা ফাইলটি একটি বৈধ ছবি হতে হবে।',
            'photo.mimes' => 'ছবি শুধুমাত্র JPG, JPEG বা PNG ফরম্যাটে হতে পারে।',
            'photo.max'   => 'ছবির আকার সর্বাধিক ২ মেগাবাইট হতে পারে।',

            'role.required' => 'পদবী নির্বাচন করা আবশ্যক।',
            'role.integer'  => 'পদবী সঠিক আকারের সংখ্যা হতে হবে।',
            'role.in'       => 'নির্বাচিত পদবী বৈধ নয়।',
            'role.unique'   => 'এই কমিটির জন্য এই পদবী ইতিমধ্যেই নির্বাচিত হয়েছে।',

            'address.required' => 'ঠিকানা অবশ্যই প্রদান করতে হবে।',
            'address.string'   => 'ঠিকানা সঠিক আকারে লিখতে হবে।',
            'address.max'      => 'ঠিকানা সর্বাধিক ৫০০ অক্ষরের হতে পারে।',

            'mobile.required' => 'মোবাইল নম্বর প্রদান করা আবশ্যক।',
            'mobile.regex'    => 'মোবাইল নম্বর সঠিকভাবে (০১XXXXXXXXX) দিতে হবে।',

            'email.required' => 'ইমেইল প্রদান করা আবশ্যক।',
            'email.email'    => 'ইমেইল ঠিকমত লিখুন।',
            'email.max'      => 'ইমেইল সর্বাধিক ২৫৫ অক্ষরের হতে পারে।',

            'facebook.required' => 'ফেসবুক প্রোফাইল লিঙ্ক প্রদান করা আবশ্যক।',
            'facebook.url'      => 'ফেসবুক লিঙ্ক সঠিক URL আকারে দিতে হবে।',
            'facebook.max'      => 'ফেসবুক লিঙ্ক সর্বাধিক ২৫৫ অক্ষরের হতে পারে।',
        ];
    }
}
