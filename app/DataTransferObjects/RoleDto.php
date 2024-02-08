<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class RoleDto
{
	public function __construct(
		public string $name,
		public array  $permissions,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			name: $request->input('name'),
			permissions: collect($request->input('permissions'))->values()->map(fn($item) => intval($item))->toArray()
		);
	}

	public function toArray(): array
	{
		return [
			'name' => $this->name,
		];
	}
}