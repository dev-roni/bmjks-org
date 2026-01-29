<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommitteeYear>
 */
class CommitteeYearFactory extends Factory {

    public function definition(): array {
        static $committeeId = 1;
        static $count = 0;

        if ($count === 2) {
            $committeeId++;
            $count = 0;
        }
        $count++;

        $status = $count === 1 ? 'deactive' : 'active';
        $year = $status === 'deactive' ? '2023' : '2025';

        return [
            'committee_id'         => $committeeId,
            'committee_name'       => "কেন্দ্রীয় কমিটি {$year}",
            'committee_start_date' => "{$year}-01-01",
            'committee_end_date'   => $status === 'deactive' ? "{$year}-12-31" : null,
            'status'               => $status,
        ];
    }
}
