<?php

namespace Tests\Feature;

use App\DataTransferObjects\MediaDto;
use App\Exceptions\MediaException;
use App\Facades\Media;
use App\Models\Seo;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServiceTest extends TestCase
{
	use WithoutMiddleware, ModelHelperTesting;

	public function testSubmitEmptyForm(): void
	{
		$response = $this->post(route('admin.services.store'));

		$response->assertInvalid();
	}

	public function testSubmitFormWithoutMedia(): void
	{
		$response = $this->post(route('admin.services.store'), [
			'title' => 'عنوان خدمت',
			'description' => 'توضیحات خدمت',
			'full_description' => 'توضیحات تکمیلی خدمت',
			'seo' => [
				'title' => 'عنوان سئو',
				'description' => 'توضیحات سئو',
				'keywords' => ['کلمه کلیدی'],
				'link' => 'لینک-سئو',
			],
		]);

		$response->assertOk();
	}

	public function testSuccessSubmitForm(): void
	{
		$response = $this->post(route('admin.services.store'), [
			'title' => 'عنوان خدمت',
			'description' => 'توضیحات خدمت',
			'full_description' => 'توضیحات تکمیلی خدمت',
			'seo' => [
				'title' => 'عنوان سئو',
				'description' => 'توضیحات سئو',
				'keywords' => ['کلمه کلیدی'],
				'link' => 'لینک-سئو',
			],
			'images' => [
				'medium_id' => 1,
				'name' => 'thumbnail',
			],
		]);

		$response->assertOk();
	}

	public function testInsertDataWithRelations()
	{
		$table = $this->model()->getTable();

		$data = Service::factory()
			->make()
			->setAppends([])
			->toArray();

		$service = Service::create($data);

		$this->assertDatabaseHas($table, $data);

		$seoData = Seo::factory()->make()->toArray();

		$service->seo()->create($seoData);

		$this->assertDatabaseHas('seos', $service->seo->toArray());

		$file = UploadedFile::fake()->image("service.png", 2000, 2000);
		try {
			$medium = Media::upload($file);
			Storage::disk(config('media.disk'))->assertExists($medium->path);

			$service->addMedia(new MediaDto(
				mediumId: $medium->id,
				name: 'featureImage'
			));
			$this->assertDatabaseHas('medium_items', ['name' => 'featureImage', 'medium_id' => $medium->id, 'model_type' => Service::class, 'model_id' => $service->id]);
		} catch (MediaException $e) {
		}
	}

	public function testUpdateData()
	{
		$data = Service::factory()
			->make()
			->setAppends([])
			->toArray();

		$service = Service::first();

		$this->assertNotNull($service);
		$this->assertNotEmpty($service);

		$this->assertTrue($service->update($data));
	}

	public function testUpdateWithRelations()
	{
		$data = Service::factory()
			->make()
			->setAppends([])
			->toArray();

		$service = Service::first();

		$this->assertNotNull($service);
		$this->assertNotEmpty($service);

		$this->assertTrue($service->update($data));

		$file = UploadedFile::fake()->image("service.png", 2000, 2000);

		$featureImage = Media::upload($file);
		Storage::disk(config('media.disk'))->assertExists($featureImage->path);

		$service->updateMedia(new MediaDto(mediumId: $featureImage->id, name: 'featureImage'));

		$service->refresh();

		foreach ($service->media as $medium) {
			Storage::disk(config('media.disk'))->assertExists($medium->path);
		}
	}

	protected function model(): Model
	{
		return new Service();
	}
}
