<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChadaSetting;

class ChadaSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChadaSetting::insert([
            [
                'central_chada_amount' => '2100',
                'branch_chada_amount' => '250',
            ],

        ]);
    }
}
