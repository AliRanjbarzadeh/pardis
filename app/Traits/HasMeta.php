<?php

namespace App\Traits;

use App\DataTransferObjects\MetaDto;
use App\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasMeta
{
	public function metas(): MorphMany
	{
		return $this->morphMany(Meta::class, 'model');
	}

	public function addMetas(Collection|MetaDto|array $metas): void
	{
		$this->metas()->createMany($this->parseMetas($metas));
	}

	public function updateMetas(Collection|MetaDto|array $metas): void
	{
		$parsed = $this->parseMetasUpdate($metas);

		if (!empty($parsed['insert'])) {
			$this->addMetas($parsed['insert']);
		}

		if (!empty($parsed['update'])) {
			foreach ($parsed['update'] as $id => $data) {
				$this->metas
					->where('id', '=', $id)
					->first()
					->update($data);
			}
		}
	}

	public function updateMeta(MetaDto|array $dto, int $metaId): bool
	{
		return $this->metas()
			->where('id', '=', $metaId)
			->update($this->parseMeta($dto));
	}

	public function deleteMetas(int|array $ids): void
	{
		if (empty($ids)) {
			$this->metas()->delete();
		} else {
			if (!is_array($ids)) {
				$ids = [$ids];
			}
			$this->metas()->whereIn('id', $ids)->delete();
		}
	}

	public function deleteMeta(Meta|int|string $item): bool
	{
		if (is_int($item)) {
			return $this->metas()
				->where('id', '=', $item)
				->delete();
		}

		if (is_string($item)) {
			return $this->metas()
				->where('meta_key', '=', $item)
				->delete();
		}

		return $item->delete();
	}

	public function incrementMeta(string $metaKey): void
	{
		$this->metas()
			->where('meta_key', '=', $metaKey)
			->increment('meta_value');
	}

	public function decrementMeta(string $metaKey): void
	{
		$this->metas()
			->where('meta_key', '=', $metaKey)
			->decrement('meta_value');
	}

	public function hasMeta(string $metaKey): bool
	{
		return $this->metas
			->where('meta_key', '=', $metaKey)
			->isNotEmpty();
	}

	public function getMetaId(string $metaKey): int
	{
		if ($this->hasMeta($metaKey)) {
			return $this->metas
				->where('meta_key', '=', $metaKey)
				->first()
				->id;
		}

		return 0;
	}

	public function getMetaValue(string $metaKey, $isJson = false): mixed
	{
		if ($this->hasMeta($metaKey)) {
			$meta = $this->metas
				->where('meta_key', '=', $metaKey)
				->first();

			if ($isJson) {
				return $meta->meta_value_json;
			}

			return $meta->meta_value;
		}

		return null;
	}

	/*======================Accessors========================*/

	/*======================Inner Methods========================*/
	private function parseMetas(Collection|MetaDto|array $metas): array
	{
		if ($metas instanceof MetaDto) {
			return [$metas->forCreate()];
		}

		if (is_array($metas)) {
			$metas = collect($metas);
		}

		return $metas->map(function (MetaDto|array $item) {
			if (is_array($item)) {
				return Arr::only($item, ['meta_key', 'meta_value']);
			}
			return $item->forCreate();
		})->filter(fn($item) => !is_null($item['meta_value']))->all();
	}

	private function parseMetasUpdate(Collection|MetaDto|array $metas): array
	{
		if ($metas instanceof MetaDto) {
			return [
				'insert' => [],
				'update' => [$metas->id => $metas->forCreate()],
			];
		}

		if (is_array($metas)) {
			$metas = collect($metas);
		}

		return [
			'insert' => $metas->where('id', '=', 0)->all(),
			'update' => $metas->where('id', '>', 0)->mapWithKeys(function (MetaDto|array $item) {
				if (is_array($item)) {
					return [$item['id'] => Arr::only($item, ['meta_key', 'meta_value'])];
				}
				return [$item->id => $item->forCreate()];
			})->all(),
		];
	}

	private function parseMeta(MetaDto|array $dto): array
	{
		if (is_array($dto)) {
			return $dto;
		}

		return $dto->forCreate();
	}
}