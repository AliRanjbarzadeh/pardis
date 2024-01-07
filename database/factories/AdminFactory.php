<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'type' => 'admin',
			'name' => 'Amin Takmili',
			'username' => 'amintakmili',
			'email' => 'amin.takmili@gmail.com',
			'email_verified_at' => now(),
			'password' => Hash::make("amin222@@@"),
			'status' => true,
			'is_super_admin' => true,
		];
	}
}