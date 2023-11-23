<?php

namespace Tests\Feature;

use App\DataTransferObjects\InsuranceDto;
use App\Models\Insurance;
use App\Services\InsuranceService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InsuranceTest extends TestCase
{
	use WithoutMiddleware;

	public function testInsertData(): void
	{
		$factory = Insurance::factory()->make();

		$file = UploadedFile::fake()->image("service.png", 2000, 2000);

		$dto = new InsuranceDto(
			name: $factory->name,
			featureImage: $file
		);

		$insurance = app(InsuranceService::class)->store($dto);

		$this->assertDatabaseHas($insurance->getTable(), ['name' => $insurance->name]);

		Storage::disk(config('media.disk'))->assertExists($insurance->getMediumByName('featureImage')->path);
	}

	public function testUpdate(): void
	{
		$factory = Insurance::factory()->make();
		$dto = new InsuranceDto(
			name: $factory->name
		);

		$insurance = Insurance::first();

		app(InsuranceService::class)->update($insurance, $dto);

		$this->assertDatabaseHas($insurance->getTable(), ['id' => $insurance->id, 'name' => $insurance->name]);
	}

	public function testUpdateWithMedia(): void
	{
		$factory = Insurance::factory()->make();

		$file = UploadedFile::fake()->image("insurance.png", 2000, 2000);

		$dto = new InsuranceDto(
			name: $factory->name,
			featureImage: $file
		);

		$insurance = Insurance::first();

		app(InsuranceService::class)->update($insurance, $dto);

		$this->assertDatabaseHas($insurance->getTable(), ['id' => $insurance->id, 'name' => $insurance->name]);

		Storage::disk(config('media.disk'))->assertExists($insurance->getMediumByName('featureImage')->path);
	}

	public function testDeleteInsurance(): void
	{
		$insurance = Insurance::first();
		$insurance->delete();

		$this->assertSoftDeleted($insurance->getTable(), ['id' => $insurance->id]);
	}
}
