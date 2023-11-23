<?php

namespace App\DataTransferObjects;

use App\Enums\TypeEnum;
use Illuminate\Http\Request;

class CategoryDto
{
	public function __construct(
		public string $name,
		public string $type,
		public SeoDto $seo,
		public int    $priority = 0,
		public ?int   $categoryId = null,

	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			name: $request->input('name'),
			type: $request->input('type'),
			seo: SeoDto::fromRequest($request),
			priority: $request->input('priority'),
			categoryId: $request->input('category_id')
		);
	}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'type' => TypeEnum::tryFrom($this->type),
			'priority' => $this->priority,
			'category_id' => $this->categoryId,
		];
	}
}