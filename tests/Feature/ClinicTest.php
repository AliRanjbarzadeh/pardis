<?php

namespace Tests\Feature;

use App\DataTransferObjects\ClinicDto;
use App\DataTransferObjects\SeoDto;
use App\Models\Clinic;
use App\Models\ClinicContactInformation;
use App\Models\Contact;
use App\Models\Insurance;
use App\Models\Medium;
use App\Models\Seo;
use App\Services\ClinicService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ClinicTest extends TestCase
{
	use WithoutMiddleware;

	public function testInsertData(): void
	{
		$data = Clinic::factory()->make();

		$contacts = [
			'id' => [],
			'title' => [],
			'value' => [],
			'type' => [],
		];
		for ($i = 0; $i < rand(1, 10); $i++) {
			$contactData = Contact::factory()->make();

			$contacts['id'][] = 0;
			$contacts['title'][] = $contactData->contact_title;
			$contacts['value'][] = $contactData->contact_value;
			$contacts['type'][] = $contactData->contact_type;
		}

		$seoDto = SeoDto::fromArray(Seo::factory()->make()->setAppends([])->toArray());

		$featureImage = UploadedFile::fake()->image("clinic.png", 2000, 2000);

		$media = Medium::orderBy('id', 'desc')
			->get()
			->map(function (Medium $medium) {
				return [
					'mediumId' => $medium->id,
					'name' => 'gallery',
				];
			})->all();

		$insuranceIds = Insurance::inRandomOrder(rand(1, 4))->limit(rand(3, 10))->get()->pluck('id')->all();

		$dto = (new ClinicDto(
			title: $data->title,
			description: $data->description,
			seo: $seoDto,
			featureImage: $featureImage
		))->setMedia($media)
			->setContacts($contacts)
			->setInsurances($insuranceIds)
			->setWorkHours($data->work_hours);

		$clinic = app(ClinicService::class)->store($dto);

		$this->assertNotNull($clinic);

		Storage::disk(config('media.disk'))->assertExists($clinic->getMediumByName('featureImage')->path);

		foreach ($clinic->getMediaByNames('gallery') as $medium) {
			Storage::disk(config('media.disk'))->assertExists($medium->path);
		}

		$this->assertDatabaseHas($clinic->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $clinic->id, 'model_type' => Clinic::class, 'keywords' => implode(',', $seoDto->keywords)]));

		foreach ($clinic->contacts as $contact) {
			$this->assertDatabaseHas($contact->getTable(), ['contact_title' => $contact->contact_title, 'contact_value' => $contact->contact_value, 'contact_type' => $contact->contact_type, 'model_type' => Clinic::class, 'model_id' => $clinic->id]);
		}

		foreach ($clinic->insurances as $insurance) {
			$this->assertDatabaseHas('insurance_items', ['insurance_id' => $insurance->id, 'model_id' => $clinic->id, 'model_type' => Clinic::class]);
		}
	}

	public function testUpdateData()
	{
		$clinic = Clinic::with(['insurances', 'contacts', 'seo', 'media'])->first();
		$this->assertNotNull($clinic);

		$data = Clinic::factory()->make();

		$contacts = [
			'id' => [],
			'title' => [],
			'value' => [],
			'type' => [],
		];
		for ($i = 0; $i < rand(1, 10); $i++) {
			$contactData = Contact::factory()->make();

			$contacts['id'][] = 0;
			$contacts['title'][] = $contactData->contact_title;
			$contacts['value'][] = $contactData->contact_value;
			$contacts['type'][] = $contactData->contact_type;
		}

		if ($clinic->contacts->isNotEmpty()) {
			foreach ($clinic->contacts->random($clinic->contacts->count() > 3 ? 3 : $clinic->contacts->count()) as $contact) {
				$contacts['id'][] = $contact->id;
				$contacts['title'][] = $contact->contact_title;
				$contacts['value'][] = $contact->contact_value;
				$contacts['type'][] = $contact->contact_type;
			}
		}


		$seoDto = SeoDto::fromArray(Seo::factory()->make()->setAppends([])->toArray());

		$featureImage = UploadedFile::fake()->image("clinic.png", 2000, 2000);

		$media = Medium::orderBy('id', 'desc')
			->get()
			->map(function (Medium $medium) {
				return [
					'mediumId' => $medium->id,
					'name' => 'gallery',
				];
			})->all();

		$insuranceIds = Insurance::inRandomOrder(rand(1, 4))->limit(rand(3, 10))->get()->pluck('id')->all();

		$dto = (new ClinicDto(
			title: $data->title,
			description: $data->description,
			seo: $seoDto,
			featureImage: $featureImage
		))->setMedia($media)
			->setContacts($contacts)
			->setInsurances($insuranceIds)
			->setWorkHours($data->work_hours);

		$updated = app(ClinicService::class)->update($clinic, $dto);

		$this->assertTrue($updated);

		$clinic->refresh();

		Storage::disk(config('media.disk'))->assertExists($clinic->getMediumByName('featureImage')->path);

		foreach ($clinic->getMediaByNames('gallery') as $medium) {
			Storage::disk(config('media.disk'))->assertExists($medium->path);
		}

		$this->assertDatabaseHas($clinic->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $clinic->id, 'model_type' => Clinic::class, 'keywords' => implode(',', $seoDto->keywords)]));

		foreach ($clinic->contacts as $contact) {
			$this->assertDatabaseHas($contact->getTable(), ['contact_title' => $contact->contact_title, 'contact_value' => $contact->contact_value, 'contact_type' => $contact->contact_type, 'model_type' => Clinic::class, 'model_id' => $clinic->id]);
		}

		foreach ($clinic->insurances as $insurance) {
			$this->assertDatabaseHas('insurance_items', ['insurance_id' => $insurance->id, 'model_id' => $clinic->id, 'model_type' => Clinic::class]);
		}
	}

	public function testDeleteData()
	{
		$clinic = Clinic::first();

		self::assertTrue($clinic->delete());
	}
}
