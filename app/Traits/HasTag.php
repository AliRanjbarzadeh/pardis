<?php

namespace App\Traits;

use App\DataTransferObjects\TagDto;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasTag
{
	public function tags(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class)->withTimestamps();
	}

	public function addTags(Collection|array $tags): void
	{
		$parsed = $this->parseTags($tags);

		if (!empty($parsed['ids'])) {
			$this->tags()->attach($parsed['ids']);
		}

		if (!empty($parsed['insert'])) {
			$this->tags()->createMany($parsed['insert']);
		}
	}

	public function updateTags(Collection|array $tags): void
	{
		$parsed = $this->parseTags($tags);

		if (!empty($parsed['ids'])) {
			$this->tags()->sync($parsed['ids']);
		} else {
			$this->tags()->detach();
		}

		if (!empty($parsed['insert'])) {
			$this->tags()->createMany($parsed['insert']);
		}
	}

	/*======================Inner Methods========================*/
	private function parseTags($tags): array
	{
		if (is_array($tags)) {
			$tags = collect($tags);
		}

		return [
			'insert' => $tags->where('id', '=', 0)->map(fn(TagDto|array $item) => is_array($item) ? Arr::except($item, ['id']) : $item->forCreate()),
			'ids' => $tags->where('id', '>', 0)->pluck('id')->all(),
		];
	}
}