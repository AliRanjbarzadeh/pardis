<?php

namespace App\DataTransferObjects;

class ContactFormResponseDto
{
	public function __construct(
		public string $answer,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'answer' => $this->answer,
		];
	}
}