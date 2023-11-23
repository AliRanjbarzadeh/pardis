<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Admin\PriorityRequest;

class PriorityDto
{
	public function __construct(
		public string $model,
		public array  $priorities,
	)
	{
	}

	public static function fromRequest(PriorityRequest $request): static
	{
		return new self(
			model: $request->input('model'),
			priorities: $request->input('priorities')
		);
	}
}