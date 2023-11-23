<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$workHours = [
			'title' => [],
			'from' => [],
			'to' => [],
		];

		for ($i = 0; $i < fake()->numberBetween(1, 7); $i++) {
			$workHours['title'][] = $this->faker->persianWord;
			$workHours['from'][] = fake()->time('H:i');
			$workHours['to'][] = fake()->time('H:i');
		}

		return [
			'first_name' => fake()->firstName,
			'last_name' => fake()->lastName,
			'medical_number' => fake()->randomDigitNotZero(),
			'description' => $this->faker->persianParagraph,
			'reservation_link' => fake()->url,
			'work_hours' => $workHours,
		];
	}
}
