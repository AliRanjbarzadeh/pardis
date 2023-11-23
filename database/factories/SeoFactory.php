<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seo>
 */
class SeoFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$title = $this->faker->persianWord;
		return [
			'title' => $title,
			'description' => fake()->realText,
			'keywords' => $this->faker->persianWords(fake()->numberBetween(1, 10)),
			'link' => Str::replace(' ', '-', $title),
		];
	}
}
