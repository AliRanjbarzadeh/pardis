<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title' => $this->faker->persianWord,
			'priority' => fake()->randomDigitNotZero(),
			'description' => fake()->realText(100),
			'full_description' => $this->faker->persianParagraph,
			'created_at' => fake()->dateTimeBetween('-30 days'),
		];
	}
}
