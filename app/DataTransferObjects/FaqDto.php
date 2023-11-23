<?php

namespace App\DataTransferObjects;

class FaqDto
{
	public function __construct(
		public int    $id,
		public string $question,
		public string $answer,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'question' => $this->question,
			'answer' => $this->answer,
		];
	}

	public function forCreate(): array
	{
		return [
			'question' => $this->question,
			'answer' => $this->answer,
		];
	}
}