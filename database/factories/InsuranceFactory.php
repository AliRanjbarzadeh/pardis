<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		fake()->imageUrl(300, 300);
		return [
			'name' => $this->faker->persianWord,
			'created_at' => fake()->dateTimeBetween('-30 days'),
		];
	}
}
