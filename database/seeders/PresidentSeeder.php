<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\President;

class PresidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        President::insert([
            "name"         => "সভাপতি",
            "message"         => "সভাপতির পক্ষ থেকে সবাইকে ধন্যবাদ",
        ]);
    }
}
