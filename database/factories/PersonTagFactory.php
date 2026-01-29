<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PersonTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonTag>
 */
class PersonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'persontype_id' => $this->faker->numberBetween(1, 10), // ১ থেকে ১০ এর মধ্যে র‍্যান্ডম সংখ্যা
            'person_id'     => $this->faker->numberBetween(1, 100), // ১ থেকে ১০০ এর মধ্যে র‍্যান্ডম সংখ্যা
        ];
    }
}
