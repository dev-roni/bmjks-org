<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notice;
use App\Models\User;
use App\Models\CommitteeActivitie;
use App\Models\Person;
use App\Models\PersonType;
use App\Models\PersonTag;
use App\Models\President;
use App\Models\Finance;
use App\Models\ChadaSetting;
class DatabaseSeeder extends Seeder
{
    public function run(): void{
		Notice::factory()->count(100)->create();
        CommitteeActivitie::factory()->count(10)->create();
        Person::factory()->count(100)->create();
        
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            CommitteeNameSeeder::class,
            PersonTypeSeeder::class,
            PresidentSeeder::class,
            CommitteeYearSeeder::class,
            CommitteeMemberSeeder::class,
            FinanceSeeder::class,
            ChadaSettingSeeder::class,
        ]);
        PersonTag::factory()->count(50)->create();
    }
}
