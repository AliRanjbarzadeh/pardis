<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class TestimonialDto
{
	public function __construct(
		public string        $description,
		public ?string       $url = null,
		public int           $priority = 0,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			description: $request->input('description'),
			url: $request->input('url'),
			priority: $request->input('priority', 0),
		);
	}

	public function toArray(): array
	{
		return [
			'priority' => $this->priority,
			'description' => $this->description,
			'url' => $this->url,
		];
	}
}