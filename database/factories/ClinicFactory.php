<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
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
			'title' => $this->faker->persianWord,
			'description' => $this->faker->persianParagraph,
			'work_hours' => $workHours,
			'created_at' => fake()->dateTimeBetween('-30 days'),
		];
	}
}
