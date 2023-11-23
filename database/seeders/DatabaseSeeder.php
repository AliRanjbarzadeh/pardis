<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call(AdminSeeder::class);
		$this->call(UserSeeder::class);
		$this->call(ServiceSeeder::class);
		$this->call(ServiceCommentSeeder::class);
		$this->call(InsuranceSeeder::class);
		$this->call(SpecialitySeeder::class);
		$this->call(SocialNetworkTypeSeeder::class);
	}
}
