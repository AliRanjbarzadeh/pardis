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
			'name' => 'Ali Ranjbarzadeh',
			'username' => 'aliranjbarzadeh',
			'email' => 'ranjbarzadehali@gmail.com',
			'email_verified_at' => now(),
			'password' => Hash::make("@Ali123987"),
			'status' => true,
			'is_super_admin' => true,
		];
	}
}