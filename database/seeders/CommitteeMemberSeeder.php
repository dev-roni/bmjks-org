<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CommitteeMember;
use Illuminate\Database\Seeder;

class CommitteeMemberSeeder extends Seeder {

    public function run(): void {
        CommitteeMember::factory()->count(25 * 16)->create();
    }
}
