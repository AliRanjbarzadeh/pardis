<?php

namespace App\DataTransferObjects;

use App\Models\Seo;
use Illuminate\Http\Request;

class SeoDto
{
	public function __construct(
		public string $title,
		public string $description,
		public array  $keywords = [],
		public string $link = '',
		public ?array $custom = null,
	)
	{
	}

	public static function fromArray(array $data): static
	{
		if (!is_array($data['keywords'])) {
			$data['keywords'] = explode(',', $data['keywords']);
		}
		return new self(
			title: $data['title'],
			description: $data['description'],
			keywords: $data['keywords'] ?? [],
			link: $data['link']
		);
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			title: $request->input('seo.title'),
			description: $request->input('seo.description'),
			keywords: $request->input('seo.keywords') ?? [],
			link: $request->input('seo.link')
		);
	}

	public function toArray(): array
	{
		return [
			'title' => $this->title,
			'description' => $this->description,
			'keywords' => $this->keywords,
			'link' => $this->link,
			'custom' => $this->custom,
		];
	}

	/*=====================Tests=======================*/
	public static function forTest(Seo $seo): static
	{
		return new self(
			title: $seo->title,
			description: $seo->description,
			keywords: explode(',', $seo->keywords),
			link: $seo->link
		);
	}
}