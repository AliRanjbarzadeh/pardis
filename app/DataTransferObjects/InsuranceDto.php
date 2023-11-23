<?php

namespace App\DataTransferObjects;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class InsuranceDto
{
	/**
	 * @param string $name
	 * @param UploadedFile|null $featureImage
	 */
	public function __construct(
		public string        $name,
		public string        $description,
		public ?array        $categories = null,
		public ?UploadedFile $featureImage = null,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			name: $request->input('name'),
			description: $request->input('description'),
			categories: $request->input('categories'),
			featureImage: $request->file('featureImage'),
		);
	}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'description' => $this->description,
		];
	}
}