<?php

namespace App\DataTransferObjects;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class BlogDto
{
	public ?Collection $tags = null;

	public function __construct(
		public int           $categoryId,
		public string        $title,
		public string        $description,
		public SeoDto        $seo,
		public ?int          $doctorId = null,
		public ?int          $clinicId = null,
		public ?UploadedFile $featureImage = null,
		public ?string       $createdAt = null,
		public ?string       $updatedAt = null,
	)
	{
	}

	public function setTags(?array $tags): static
	{
		if (!is_null($tags)) {
			$this->tags = collect();

			array_map(function ($tag) {
				if (is_numeric($tag)) {
					$this->tags->push(new TagDto(id: $tag, name: ''));
				} else {
					$this->tags->push(new TagDto(id: 0, name: $tag));
				}
			}, $tags);
		}
		return $this;
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			categoryId: $request->input('category_id'),
			title: $request->input('title'),
			description: $request->input('description'),
			seo: SeoDto::fromRequest($request),
			doctorId: $request->input('doctor_id'),
			clinicId: $request->input('clinic_id'),
			featureImage: $request->file('featureImage')
		);
	}

	public function toArray(): array
	{
		if (!is_null($this->createdAt)) {
			return [
				'title' => $this->title,
				'description' => $this->description,
				'created_at' => $this->createdAt,
				'updated_at' => $this->updatedAt,
			];
		}
		return [
			'title' => $this->title,
			'description' => $this->description,
		];
	}

	public function setTimeStamps(string $createdAt, string $updatedAt): static
	{
		$this->createdAt = $createdAt;
		$this->updatedAt = $updatedAt;
		return $this;
	}

	/*=====================Tests=======================*/
	public static function forTest(Blog $blog, int $categoryId, int $clinicId, int $doctorId, array $tags, SeoDto $seoDto, UploadedFile $featureImage): static
	{
		return (new self(
			categoryId: $categoryId,
			title: $blog->title,
			description: $blog->description,
			seo: $seoDto,
			doctorId: $doctorId,
			clinicId: $clinicId,
			featureImage: $featureImage
		))->setTags($tags);
	}
}