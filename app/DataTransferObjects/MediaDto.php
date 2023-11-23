<?php

namespace App\DataTransferObjects;

class MediaDto
{
	public function __construct(
		public int    $mediumId,
		public string $name,
	)
	{
	}

	public static function fromArray(array $medium): MediaDto
	{
		return new self(
			mediumId: $medium['mediumId'],
			name: $medium['name'],
		);
	}

	public function toArray(): array
	{
		return [
			'medium_id' => $this->mediumId,
			'name' => $this->name,
		];
	}
}