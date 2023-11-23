<?php

namespace App\DataTransferObjects;

class WorkHourDto
{
	public function __construct(
		public string $title,
		public array $first,
		public array $second,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'title' => $this->title,
			'first' => $this->first,
			'second' => $this->second,
		];
	}
}