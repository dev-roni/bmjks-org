<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommitteeName;

class CommitteeNameSeeder extends Seeder {

    public function run(): void {
        CommitteeName::insert([
            [
                "committee_name" => "কেন্দ্রীয় কমিটি",
                "committee_slug" => "M",
            ],
            [
                "committee_name" => "বালিগাঁও শাখা",
                "committee_slug" => "A",
            ],
            [
                "committee_name" => "মাধবপুর শাখা",
                "committee_slug" => "B",
            ],
            [
                "committee_name" => "ঘোরামারা শাখা",
                "committee_slug" => "C",
            ],
            [
                "committee_name" => "তিলকপুর শাখা",
                "committee_slug" => "D",
            ],
            [
                "committee_name" => "ভানুবিল শাখা",
                "committee_slug" => "E",
            ],
            [
                "committee_name" => "তেতইগাও শাখা",
                "committee_slug" => "F",
            ],
            [
                "committee_name" => "ঢালুয়া শাখা",
                "committee_slug" => "G",
            ],
            [
                "committee_name" => "গোলেরহাওর শাখা",
                "committee_slug" => "H",
            ],
            [
                "committee_name" => "মাছিমপুর শাখা",
                "committee_slug" => "I",
            ],
            [
                "committee_name" => "ধনিটিলা শাখা",
                "committee_slug" => "J",
            ],
            [
                "committee_name" => "মাঝেরগাও শাখা",
                "committee_slug" => "K",
            ],
            [
                "committee_name" => "বিশগাও শাখা",
                "committee_slug" => "L",
            ]
        ]);
    }
}
