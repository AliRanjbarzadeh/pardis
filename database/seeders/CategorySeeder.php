<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Category::factory()->createMany(20);

		Category::factory(2)->make(['type' => TypeEnum::Insurance])->map(function (Category $category) {
			$category->save();
			Category::factory(5)->create(['type' => TypeEnum::Insurance, 'category_id' => $category->id]);
		});
	}
}
