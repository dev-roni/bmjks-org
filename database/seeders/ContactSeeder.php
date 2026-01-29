<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder {

    public function run(): void {
        Contact::insert([
            [
                "name"          => "অমিত সিংহ",
                "phone_no"      => "01710000000",
                "email"         => "amit@example.com",
                "read_status"   => "unread",
                "message_title" => "ওয়েবসাইট সমস্যা",
                "message"       => "আমি ওয়েবসাইটের লগইন সিস্টেমে সমস্যা পাচ্ছি।",
            ],
            [
                "name"          => "রহিম উদ্দিন",
                "phone_no"      => "01820000000",
                "email"         => "rahim@example.com",
                "read_status"   => "read",
                "message_title" => "সেবা অনুরোধ",
                "message"       => "আমি আপনার ওয়েব ডেভেলপমেন্ট সেবাগুলি সম্পর্কে জানতে চাই।",
            ],
            [
                "name"          => "ফাতেমা খাতুন",
                "phone_no"      => "01930000000",
                "email"         => "fatema@example.com",
                "read_status"   => "unread",
                "message_title" => "মতামত",
                "message"       => "আপনাদের ওয়েবসাইটটি অনেক উপকারী এবং ব্যবহারবান্ধব। চালিয়ে যান।",
            ],
            [
                "name"          => "সাব্বির হোসেন",
                "phone_no"      => "01640000000",
                "email"         => "sabbir@example.com",
                "read_status"   => "read",
                "message_title" => "অংশীদারিত্ব",
                "message"       => "আমি আপনার প্রতিষ্ঠানের সাথে কাজ করতে আগ্রহী।",
            ],
            [
                "name"          => "নুসরাত জাহান",
                "phone_no"      => "01550000000",
                "email"         => "nusrat@example.com",
                "read_status"   => "unread",
                "message_title" => "জিজ্ঞাসা",
                "message"       => "আপনার ট্রেনিং প্রোগ্রাম সম্পর্কে বিস্তারিত জানতে চাই।",
            ],
        ]);
    }
}
