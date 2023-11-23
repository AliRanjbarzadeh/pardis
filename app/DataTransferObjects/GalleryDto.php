<?php

namespace App\DataTransferObjects;


use Illuminate\Http\UploadedFile;

class GalleryDto
{
	public function __construct(
		public string        $title,
		public int           $categoryId,
		public SeoDto        $seo,
		public ?UploadedFile $featureImage,
	)
	{
	}

	public
	function toArray(): array
	{
		return [
			'title' => $this->title,
		];
	}
}