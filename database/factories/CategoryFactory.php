<?php

namespace Database\Factories;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'priority' => rand(1, 10),
			'name' => $this->faker->persianWord,
			'type' => fake()->randomElement([TypeEnum::Blog, TypeEnum::Gallery, TypeEnum::Personnel]),
		];
	}
}
