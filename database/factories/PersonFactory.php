<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
 public function definition(): array
    {
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $genders = ['Male', 'Female', 'Other'];
        $maritalStatuses = ['Single', 'Married', 'Divorced', 'Widowed'];
        $donator = ['no','yes'];
        $relation_type = ['পিতা', 'স্বামী'];
        $member_aproved = ['yes','no'];

        return [
            'name'                => $this->faker->name(),
            'relation_type'       => $this->faker->randomElement($relation_type),
            'father_husband_name' => $this->faker->name('male'),
            'mother_name'         => $this->faker->name('female'),
            'photo'               => $this->faker->imageUrl(200, 200, 'people'),
            'date_of_birth'       => $this->faker->date(),
            'gender'              => $this->faker->randomElement($genders),
            'caste'               => $this->faker->word(),
            'marital_status'      => $this->faker->randomElement($maritalStatuses),
            'mobile_number'       => '01' . $this->faker->numberBetween(300000000, 999999999),
            'village'             => $this->faker->streetName(),
            'post_office'         => $this->faker->word(),
            'thana'               => $this->faker->city(),
            'district'            => $this->faker->state(),
            'profession'          => $this->faker->jobTitle(),
            'blood_group'         => $this->faker->randomElement($bloodGroups),
            'donator'             => $this->faker->randomElement($donator),
            'member_aproved'      => $this->faker->randomElement($member_aproved)
        ];
    }
}
