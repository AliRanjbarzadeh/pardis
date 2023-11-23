<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceCommentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$services = Service::all();
		$services->map(function (Service $service) {
			$comments = Comment::factory(10)->make();
			$service->comments()->saveMany($comments);
		});
	}
}
