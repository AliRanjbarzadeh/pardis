<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$value = fake()->randomElement([fake()->phoneNumber, fake()->email, fake()->url]);

		$type = 'tell';
		if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$type = 'email';
		}

		if (filter_var($value, FILTER_VALIDATE_URL)) {
			$type = 'url';
		}

		return [
			'contact_title' => fake()->name,
			'contact_value' => $value,
			'contact_type' => $type,
		];
	}
}
