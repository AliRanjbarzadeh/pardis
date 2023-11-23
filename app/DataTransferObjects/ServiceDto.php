<?php

namespace App\DataTransferObjects;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ServiceDto extends BaseDto
{
	/**
	 * @param string $title
	 * @param string $description
	 * @param string $fullDescription
	 * @param SeoDto $seo
	 * @param UploadedFile|null $featureImage
	 */
	public function __construct(
		public string        $title,
		public string        $description,
		public string        $fullDescription,
		public SeoDto        $seo,
		public ?UploadedFile $featureImage = null,
		public ?UploadedFile $iconImage = null,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'title' => $this->title,
			'description' => $this->description,
			'full_description' => $this->fullDescription,
		];
	}
}