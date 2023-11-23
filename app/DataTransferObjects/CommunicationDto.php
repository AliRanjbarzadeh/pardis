<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class CommunicationDto
{
	public function __construct(
		public string $title,
		public array  $routes,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			title: $request->input('title'),
			routes: $request->input('routes')
		);
	}

	public function toArray(): array
	{
		$routes = collect($this->routes)->filter(function ($route) {
			$lines = collect($route['lines']);
			return $lines->filter(fn($line) => !is_null($line))->isNotEmpty();
		})->map(function ($route) {
			$lines = collect($route['lines']);
			return [
				'lines' => $lines->filter(fn($line) => !is_null($line))->all(),
			];
		});
		return [
			'title' => $this->title,
			'routes' => $routes->all(),
		];
	}
}