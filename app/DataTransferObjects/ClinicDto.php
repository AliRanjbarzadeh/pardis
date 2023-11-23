<?php

namespace App\DataTransferObjects;


use Illuminate\Http\UploadedFile;

class ClinicDto extends BaseDto
{
	/**
	 * @param string $title
	 * @param string $description
	 * @param SeoDto $seo
	 * @param UploadedFile|null $featureImage
	 */
	public function __construct(
		public string        $title,
		public string        $description,
		public SeoDto        $seo,
		public ?UploadedFile $featureImage = null,
	)
	{
	}

	public function forCreate(): array
	{
		return [
			'title' => $this->title,
			'description' => $this->description,
			'work_hours' => $this->workHours?->map(function (WorkHourDto $dto) {
				return $dto->toArray();
			})?->all(),
		];
	}
}