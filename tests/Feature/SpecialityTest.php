<?php

namespace Tests\Feature;

use App\DataTransferObjects\SpecialityDto;
use App\Models\Speciality;
use App\Services\SpecialityService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SpecialityTest extends TestCase
{
	use WithoutMiddleware;

	public function testInsertData()
	{
		$data = Speciality::factory()->make();

		$dto = new SpecialityDto(
			name: $data->name
		);

		$speciality = app(SpecialityService::class)->store($dto);

		$this->assertNotNull($speciality);
	}

	public function testUpdateData()
	{
		$data = Speciality::factory()->make();

		$dto = new SpecialityDto(
			name: $data->name
		);

		$speciality = Speciality::first();

		self::assertTrue(app(SpecialityService::class)->update($speciality, $dto));
	}

	public function testDeleteData()
	{
		$speciality = Speciality::first();

		self::assertTrue($speciality->delete());
	}
}
