<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PersonType;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonType::insert([
            [
                "person_type_name" => "আজীবন সদস্য",
                "status"           => "active"          
            ],
            [
                "person_type_name" => "সাধারন সদস্য",
                "status"           => "active"
            ],
            [
                "person_type_name" => "বামুন",
                "status"           => "deactive"
            ],
            [
                "person_type_name" => "ডাকুলা",
                "status"           => "active"
            ],
            [
                "person_type_name" => "ইসালপা",
                "status"           => "active"
            ],
            [
                "person_type_name" => "ডাক্তার",
                "status"           => "active"
            ],
            [
               "person_type_name" => "বিসিএস ক্যাডার",
                "status"           => "active"
            ],
            [
               "person_type_name" => "শিক্ষক",
                "status"           => "active"
            ],
            [
               "person_type_name" => "সরকারি চাকুরিজীবি",
                "status"           => "active"
            ],
            [
               "person_type_name" => "বেসরকারি চাকুরিজীবি",
                "status"           => "active"
            ],

        ]);
    }
}
