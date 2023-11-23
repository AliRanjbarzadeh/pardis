<?php

namespace App\DataTransferObjects;

class SpecialityDto
{
	public function __construct(
		public string $name,
		public SeoDto $seo,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
		];
	}
}