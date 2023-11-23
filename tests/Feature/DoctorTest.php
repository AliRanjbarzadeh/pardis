<?php

namespace Tests\Feature;

use App\DataTransferObjects\DoctorDto;
use App\DataTransferObjects\SeoDto;
use App\Models\Clinic;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\Insurance;
use App\Models\Medium;
use App\Models\Seo;
use App\Models\SocialNetworkType;
use App\Models\Speciality;
use App\Services\DoctorService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DoctorTest extends TestCase
{
	public function testInsert()
	{
		$data = Doctor::factory()->make();

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

		$featureImage = UploadedFile::fake()->image("doctor.png", 2000, 2000);

		$media = Medium::orderBy('id', 'desc')
			->limit(rand(1, 10))
			->inRandomOrder()
			->get()
			->map(function (Medium $medium) {
				return [
					'mediumId' => $medium->id,
					'name' => 'gallery',
				];
			})->all();

		$insuranceIds = Insurance::inRandomOrder(rand(1, 4))->limit(rand(3, 10))->get()->pluck('id')->all();

		$socialNetworks = [
			'id' => [],
			'title' => [],
			'address' => [],
			'type_id' => [],
		];
		$socialNetworkTypes = SocialNetworkType::all();
		for ($j = 0; $j < rand(1, 5); $j++) {
			foreach ($socialNetworkTypes as $type) {
				$socialNetworks['id'][] = 0;
				$socialNetworks['title'][] = fake()->name;
				$socialNetworks['address'][] = fake()->url;
				$socialNetworks['type_id'][] = $type->id;
			}
		}

		$clinic = Clinic::inRandomOrder()->limit(rand(1, 10))->get();
		$speciality = Speciality::inRandomOrder()->first();

		$resumes = [
			'title' => [],
		];
		for ($k = 0; $k < rand(1, 10); $k++) {
			$resumes['title'][] = fake()->word;
		}

		$dto = (new DoctorDto(
			specialityId: $speciality->id,
			clinics: $clinic->pluck('id')->all(),
			firstName: $data->first_name,
			lastName: $data->last_name,
			medicalNumber: $data->medical_number,
			description: $data->description,
			reservationLink: $data->reservation_link,
			seo: $seoDto,
			featureImage: $featureImage
		))->setMedia($media)
			->setInsurances($insuranceIds)
			->setWorkHours($data->work_hours)
			->setContacts($contacts)
			->setSocialNetworks($socialNetworks)
			->setResumes($resumes);

		$doctor = app(DoctorService::class)->store($dto);
		$this->assertNotNull($doctor);

		$doctor->refresh();

		Storage::disk(config('media.disk'))->assertExists($doctor->getMediumByName('featureImage')->path);

		foreach ($doctor->getMediaByNames('gallery') as $medium) {
			Storage::disk(config('media.disk'))->assertExists($medium->path);
		}

		$this->assertDatabaseHas($doctor->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $doctor->id, 'model_type' => Doctor::class, 'keywords' => implode(',', $seoDto->keywords)]));

		foreach ($doctor->contacts as $contact) {
			$this->assertDatabaseHas($contact->getTable(), ['contact_title' => $contact->contact_title, 'contact_value' => $contact->contact_value, 'contact_type' => $contact->contact_type, 'model_type' => Doctor::class, 'model_id' => $doctor->id]);
		}

		foreach ($doctor->insurances as $insurance) {
			$this->assertDatabaseHas('insurance_items', ['insurance_id' => $insurance->id, 'model_id' => $doctor->id, 'model_type' => Doctor::class]);
		}

		foreach ($doctor->socialNetworks as $socialNetwork) {
			$this->assertDatabaseHas('social_networks', ['social_network_type_id' => $socialNetwork->social_network_type_id, 'title' => $socialNetwork->title, 'address' => $socialNetwork->address, 'model_type' => Doctor::class, 'model_id' => $doctor->id]);
		}
	}

	public function testUpdate()
	{
		$doctor = Doctor::with(['socialNetworks', 'contacts', 'seo', 'media'], 'insurances', 'specialities')->latest()->limit(1)->get()->first();
		$data = Doctor::factory()->make();

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
		if ($doctor->contacts->isNotEmpty()) {
			foreach ($doctor->contacts->random($doctor->contacts->count() > 3 ? 3 : $doctor->contacts->count()) as $contact) {
				$contacts['id'][] = $contact->id;
				$contacts['title'][] = $contact->contact_title;
				$contacts['value'][] = $contact->contact_value;
				$contacts['type'][] = $contact->contact_type;
			}
		}

		$seoDto = SeoDto::fromArray(Seo::factory()->make()->setAppends([])->toArray());

		$featureImage = UploadedFile::fake()->image("doctor.png", 2000, 2000);

		$media = Medium::orderBy('id', 'desc')
			->limit(rand(1, 10))
			->inRandomOrder()
			->get()
			->map(function (Medium $medium) {
				return [
					'mediumId' => $medium->id,
					'name' => 'gallery',
				];
			})->all();

		$insuranceIds = Insurance::inRandomOrder(rand(1, 4))->limit(rand(3, 10))->get()->pluck('id')->all();

		$socialNetworks = [
			'id' => [],
			'title' => [],
			'address' => [],
			'type_id' => [],
		];
		$socialNetworkTypes = SocialNetworkType::all();
		for ($j = 0; $j < rand(1, 5); $j++) {
			foreach ($socialNetworkTypes as $type) {
				$socialNetworks['id'][] = 0;
				$socialNetworks['title'][] = fake()->name;
				$socialNetworks['address'][] = fake()->url;
				$socialNetworks['type_id'][] = $type->id;
			}
		}

		if ($doctor->socialNetworks->isNotEmpty()) {
			foreach ($doctor->socialNetworks->random($doctor->socialNetworks->count() > 3 ? 3 : $doctor->socialNetworks->count()) as $socialNetwork) {
				$socialNetworks['id'][] = $socialNetwork->id;
				$socialNetworks['title'][] = fake()->name;
				$socialNetworks['address'][] = fake()->url;
				$socialNetworks['type_id'][] = $socialNetwork->social_network_type_id;
			}
		}

		$clinic = Clinic::inRandomOrder()->limit(rand(1, 10))->get();
		$speciality = Speciality::inRandomOrder()->first();

		$resumes = [
			'title' => [],
		];
		for ($k = 0; $k < rand(1, 10); $k++) {
			$resumes['title'][] = fake()->word;
		}

		$dto = (new DoctorDto(
			specialityId: $speciality->id,
			clinics: $clinic->pluck('id')->all(),
			firstName: $data->first_name,
			lastName: $data->last_name,
			medicalNumber: $data->medical_number,
			description: $data->description,
			reservationLink: $data->reservation_link,
			seo: $seoDto,
			featureImage: $featureImage
		))->setMedia($media)
			->setInsurances($insuranceIds)
			->setWorkHours($data->work_hours)
			->setContacts($contacts)
			->setSocialNetworks($socialNetworks)
			->setResumes($resumes);

		$this->assertTrue(app(DoctorService::class)->update($doctor, $dto));

		$doctor->refresh();

		Storage::disk(config('media.disk'))->assertExists($doctor->getMediumByName('featureImage')->path);

		foreach ($doctor->getMediaByNames('gallery') as $medium) {
			Storage::disk(config('media.disk'))->assertExists($medium->path);
		}

		$this->assertDatabaseHas($doctor->seo->getTable(), array_merge($seoDto->toArray(), ['model_id' => $doctor->id, 'model_type' => Doctor::class, 'keywords' => implode(',', $seoDto->keywords)]));

		foreach ($doctor->contacts as $contact) {
			$this->assertDatabaseHas($contact->getTable(), ['contact_title' => $contact->contact_title, 'contact_value' => $contact->contact_value, 'contact_type' => $contact->contact_type, 'model_type' => Doctor::class, 'model_id' => $doctor->id]);
		}

		foreach ($doctor->insurances as $insurance) {
			$this->assertDatabaseHas('insurance_items', ['insurance_id' => $insurance->id, 'model_id' => $doctor->id, 'model_type' => Doctor::class]);
		}

		foreach ($doctor->socialNetworks as $socialNetwork) {
			$this->assertDatabaseHas('social_networks', ['social_network_type_id' => $socialNetwork->social_network_type_id, 'title' => $socialNetwork->title, 'address' => $socialNetwork->address, 'model_type' => Doctor::class, 'model_id' => $doctor->id]);
		}
	}
}
