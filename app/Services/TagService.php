<?php

namespace App\Services;

use App\DataTransferObjects\TagDto;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
	public function store(TagDto $dto): ?Tag
	{
		return Tag::create($dto->toArray());
	}

	public function update(Tag $tag, TagDto $dto): bool
	{
		return $tag->update($dto->toArray());
	}

	/**
	 * @return Collection|array|Tag[]
	 */
	public function all(): Collection|array
	{
		return Tag::orderBy('name')->get();
	}
}