<?php

namespace App\DataTransferObjects;

use App\Helpers\General;
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
		$title = $request->input('seo.title');

		if (empty($title)) {
			if ($request->has('title')) {
				$title = $request->input('title');
			}

			if ($request->has('name')) {
				$title = $request->input('name');
			}

			if ($request->has('first_name')) {
				$title = $request->input('first_name');

				if ($request->has('last_name')) {
					$title .= ' ' . $request->input('last_name');
				}
			}
		}

		$link = $request->input('seo.link');
		if (empty($link)) {
			$link = General::toSeoUrl($title);
		}

		$custom = null;
		if ($request->has('seo.canonical') && !empty($request->input('seo.canonical'))) {
			$custom['canonical'] = $request->input('seo.canonical');
		}

		if ($request->has('seo.robots')) {
			$custom['robots'] = $request->input('seo.robots');
		}

		return new self(
			title: $title,
			description: $request->input('seo.description') ?? '',
			keywords: $request->input('seo.keywords') ?? [],
			link: $link,
			custom: $custom
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