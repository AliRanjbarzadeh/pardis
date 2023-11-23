<?php

namespace App\DataTransferObjects;

class MetaDto
{
	public function __construct(
		public string $metaKey,
		public mixed  $metaValue,
		public int    $id = 0,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'meta_key' => $this->metaKey,
			'meta_value' => $this->metaValue,
		];
	}

	public function forCreate(): array
	{
		return [
			'meta_key' => $this->metaKey,
			'meta_value' => $this->metaValue,
		];
	}
}