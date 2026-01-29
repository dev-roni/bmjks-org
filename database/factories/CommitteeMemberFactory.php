<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommitteeMemberFactory extends Factory {

    public function definition(): array {
        static $committeeYearId = 1;
        static $role = 1;

        // প্রতিটি কমিটির জন্য ১৬ জন সদস্য
        if ($role > 16) {
            $committeeYearId++;
            $role = 1;
        }

        return [
            'CommitteeYear_id' => $committeeYearId,
            'name'             => $this->faker->name(),
            'photo'            => null,
            'role'             => $role++,
            'address'          => $this->faker->address(),
            'mobile'           => $this->faker->unique()->phoneNumber(),
            'email'            => $this->faker->unique()->safeEmail(),
            'facebook'         => 'https://facebook.com/' . $this->faker->userName(),
        ];
    }
}
