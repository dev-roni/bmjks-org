<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Finance;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finance::insert([
            [
                'title' => 'Annual Report 2025',
                'date' => '2025-10-20',
                'pdf_path' => '1761637547.pdf',
            ],
            [
                'title' => 'Monthly Meeting Notes',
                'date' => '2025-09-15',
                'pdf_path' => '1761637547.pdf',
            ],
            [
                'title' => 'Project Proposal',
                'date' => '2025-08-10',
                'pdf_path' => '1760283049.pdf',
            ],
            [
                'title' => 'Financial Statement Q1',
                'date' => '2025-07-05',
                'pdf_path' => '1760283049.pdf',
            ],
            [
                'title' => 'Financial Statement Q1',
                'date' => '2025-07-05',
                'pdf_path' => '1760283049.pdf',
            ],
        ]);
    }
}
