<?php

namespace Database\Factories;
use App\Models\CommitteeActivitie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommitteeActivitieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CommitteeActivitie::class;
    public function definition(): array
    {
       return [
            'committee_year_id'=> 1,
            'title' => 'happy new year consart',
            'description' => 'amra ei consart ti anonder jonno ayojon koresi',
            'activities_date' => now(),
        ];
    }
}
