<?php

namespace App\DataTransferObjects;

use App\Enums\PopupTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PopupDto
{
	public function __construct(
		public PopupTypeEnum $type = PopupTypeEnum::Text,
		public StatusEnum    $status = StatusEnum::Active,
		public ?string       $title = null,
		public ?string       $description = null,
		public ?string       $url = null,
		public ?UploadedFile $featureImage = null,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		if ($request->has('status')) {
			return new self(
				status: StatusEnum::tryFrom($request->input('status')),
			);
		}
		return new self(
			type: PopupTypeEnum::tryFrom($request->input('type')),
			title: $request->input('title'),
			description: $request->input('description'),
			url: $request->input('url'),
			featureImage: $request->file('featureImage')
		);
	}

	public function toArray(): array
	{
		return [
			'type' => $this->type,
			'status' => $this->status,
			'title' => $this->title,
			'description' => $this->description,
			'url' => $this->url,
		];
	}

	public function toArrayStatus(): array
	{
		return [
			'status' => $this->status,
		];
	}
}