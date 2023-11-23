<?php

namespace App\DataTransferObjects;

class ResumeDto
{
	public function __construct(
		public string $title,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'title' => $this->title,
		];
	}
}