<?php

namespace App\DataTransferObjects;

class TagDto
{
	public function __construct(
		public int    $id,
		public string $name,
	)
	{
	}

	public function forCreate(): array
	{
		return [
			'name' => $this->name,
		];
	}

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
		];
	}
}