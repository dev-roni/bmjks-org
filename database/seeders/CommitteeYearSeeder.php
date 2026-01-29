<?php

namespace Database\Seeders;

use App\Models\CommitteeYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CommitteeYearSeeder extends Seeder {

    public function run(): void
    {
        $committees = [
            ["id" => 1, "name" => "কেন্দ্রীয় কমিটি"],
            ["id" => 2, "name" => "বালিগাঁও শাখা"],
            ["id" => 3, "name" => "মাধবপুর শাখা"],
            ["id" => 4, "name" => "ঘোরামারা শাখা"],
            ["id" => 5, "name" => "তিলকপুর শাখা"],
            ["id" => 6, "name" => "ভানুবিল শাখা"],
            ["id" => 7, "name" => "তেতইগাও শাখা"],
            ["id" => 8, "name" => "ঢালুয়া শাখা"],
            ["id" => 9, "name" => "গোলেরহাওর শাখা"],
            ["id" => 10, "name" => "মাছিমপুর শাখা"],
            ["id" => 11, "name" => "ধনিটিলা শাখা"],
            ["id" => 12, "name" => "মাঝেরগাও শাখা"],
            ["id" => 13, "name" => "বিশগাও শাখা"],
        ];

        $today = Carbon::now()->toDateString();

        foreach ($committees as $c) {

            CommitteeYear::create([
                "committee_id" => $c['id'],
                "committee_name" => $c['name'],
                "committee_start_date" => $today,
                "committee_end_date" => null,
                "status" => "active"
            ]);

            CommitteeYear::create([
                "committee_id" => $c['id'],
                "committee_name" => $c['name'],
                "committee_start_date" => $today,
                "committee_end_date" => null,
                "status" => "deactive"
            ]);
        }
    }
}
