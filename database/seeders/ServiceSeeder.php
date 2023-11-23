<?php

namespace Database\Seeders;

use App\DataTransferObjects\MediaDto;
use App\Facades\Media;
use App\Models\Seo;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ServiceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Service::factory(20)
			->create()
			->each(function (Service $service) {
				$service->seo()->create(Seo::factory()->count(1)->makeOne()->toArray());

				$service->upload(UploadedFile::fake()->image('service.png', 200, 200), 'featureImage');

				$medium = Media::upload(UploadedFile::fake()->image('serviceGallery.png', 1024, 1024));
				$service->addMedia(new MediaDto(mediumId: $medium->id, name: 'gallery'));
			});
	}
}
