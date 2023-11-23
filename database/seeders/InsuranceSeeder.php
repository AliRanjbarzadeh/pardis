<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class InsuranceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Insurance::factory(10)->make()->map(function (Insurance $insurance) {
			$insurance->save();

			$insurance->upload(UploadedFile::fake()->image('insurance.png', 200, 200), 'featureImage');
		});

	}
}
