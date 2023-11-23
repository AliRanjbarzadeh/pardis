<?php

namespace App\DataTransferObjects;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class DoctorDto extends BaseDto
{

	public function __construct(
		public int           $specialityId,
		public string        $firstName,
		public string        $lastName,
		public string        $medicalNumber,
		public string        $description,
		public string        $fullDescription,
		public string        $reservationLink,
		public SeoDto        $seo,
		public ?array         $clinics = null,
		public ?UploadedFile $featureImage = null,
	)
	{
	}

	public function forCreate(): array
	{
		return [
			'first_name' => $this->firstName,
			'last_name' => $this->lastName,
			'medical_number' => $this->medicalNumber,
			'description' => $this->description,
			'full_description' => $this->fullDescription,
			'work_hours' => $this->workHours?->map(function (WorkHourDto $dto) {
				return $dto->toArray();
			})?->all(),
			'reservation_link' => $this->reservationLink,
		];
	}

	public static function fromRequest(Request $request):static
	{
		return new self(
			specialityId: $request->input('speciality_id'),
			firstName: $request->input('first_name'),
			lastName: $request->input('last_name'),
			medicalNumber: $request->input('medical_number'),
			description: $request->input('description'),
			fullDescription: $request->input('full_description'),
			reservationLink: $request->input('reservation_link'),
			seo: SeoDto::fromRequest($request),
			clinics: $request->input('clinics'),
			featureImage: $request->file('featureImage')
		);
	}
}