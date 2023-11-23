<?php

namespace App\DataTransferObjects;

use App\Enums\SliderPageEnum;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderEditRequest;
use Illuminate\Http\UploadedFile;

class SliderDto extends BaseDto
{
	public function __construct(
		public SliderPageEnum $page,
		public ?UploadedFile   $featureImage,
		public int            $priority = 0,
		public ?string        $title = null,
		public ?string        $description = null,
		public ?string        $link = null,
	)
	{
	}

	public static function fromRequest(SliderCreateRequest|SliderEditRequest $request, SliderPageEnum $page): static
	{
		return new self(
			page: $page,
			featureImage: $request->file('featureImage'),
			priority: $request->post('priority', 0),
			title: $request->post('title'),
			description: $request->post('description'),
			link: $request->post('link'),
		);
	}

	public function toArray(): array
	{
		return [
			'page' => $this->page,
			'priority' => $this->priority,
			'title' => $this->title,
			'description' => $this->description,
			'link' => $this->link,
		];
	}
}