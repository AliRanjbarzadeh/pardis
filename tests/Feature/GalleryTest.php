<?php

namespace Tests\Feature;

use App\DataTransferObjects\GalleryDto;
use App\DataTransferObjects\SeoDto;
use App\Enums\TypeEnum;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Seo;
use App\Services\GalleryService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryTest extends TestCase
{
	public function testInsert()
	{
		$data = Gallery::factory()->make();
		$category = Category::whereType(TypeEnum::Gallery)->inRandomOrder()->first();

		$seoDto = SeoDto::fromArray(Seo::factory()->make()->setAppends([])->toArray());

		$featureImage = UploadedFile::fake()->image("gallery.png", 2000, 2000);

		$dto = new GalleryDto(
			title: $data->title,
			categoryId: $category->id,
			seo: $seoDto,
			featureImage: $featureImage
		);

		$gallery = app(GalleryService::class)->store($dto);

		$this->assertNotNull($gallery);

		Storage::disk(config('media.disk'))->assertExists($gallery->getMediumByName('featureImage')->path);

		$this->assertDatabaseHas($gallery->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $gallery->id, 'model_type' => Gallery::class, 'keywords' => implode(',', $seoDto->keywords)]));
	}

	public function testUpdate()
	{
		$data = Gallery::factory()->make();
		$gallery = Gallery::with(['seo', 'media', 'categories'])->inRandomOrder()->first();
		$category = Category::whereType(TypeEnum::Gallery)->inRandomOrder()->first();

		$seoDto = SeoDto::fromArray(Seo::factory()->make()->setAppends([])->toArray());

		$featureImage = UploadedFile::fake()->image("gallery.png", 2000, 2000);

		$dto = new GalleryDto(
			title: $data->title,
			categoryId: $category->id,
			seo: $seoDto,
			featureImage: $featureImage
		);

		$this->assertTrue(app(GalleryService::class)->update($gallery, $dto));

		$gallery->refresh();

		Storage::disk(config('media.disk'))->assertExists($gallery->getMediumByName('featureImage')->path);

		$this->assertDatabaseHas($gallery->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $gallery->id, 'model_type' => Gallery::class, 'keywords' => implode(',', $seoDto->keywords)]));
	}
}
