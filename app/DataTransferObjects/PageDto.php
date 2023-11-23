<?php

namespace App\DataTransferObjects;

use App\Enums\PageTypeEnum;
use App\Helpers\General;
use App\Http\Requests\Admin\PageRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class PageDto extends BaseDto
{
	public ?Collection $metas = null;
	public ?PageTypeEnum $type = null;

	public function __construct(
		public ?string $title = null,
		public ?string $description = null,
		public ?string $fullDescription = null,
		public ?SeoDto $seo = null,
		public ?UploadedFile $featureImage = null,
	)
	{
	}

	public function setMetas(?array $metas): static
	{
		if (!empty($metas)) {
			$this->metas = collect();
			foreach ($metas as $metaKey => $metaValue) {
				if (is_string($metaValue)) {
					$metaValue = General::fromJson($metaValue, true);
				}
				$this->metas->push(new MetaDto(
					metaKey: $metaKey, metaValue: $metaValue
				));
			}
		}
		return $this;
	}

	public function setType(PageTypeEnum $type): static
	{
		$this->type = $type;
		return $this;
	}

	public static function fromRequest(PageRequest $request): static
	{
		return new self(
			title: $request->input('title'),
			description: $request->input('description'),
			fullDescription: $request->input('full_description'),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage'),
		);
	}

	public function toArray(): array
	{
		return [
			'type' => $this->type,
			'title' => $this->title,
			'description' => $this->description,
			'full_description' => $this->fullDescription,
		];
	}
}