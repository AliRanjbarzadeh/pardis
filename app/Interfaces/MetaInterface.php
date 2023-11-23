<?php

namespace App\Interfaces;

use App\DataTransferObjects\MetaDto;
use App\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface MetaInterface
{
	public function metas(): MorphMany;

	public function addMetas(Collection|array $metas): void;

	public function updateMetas(Collection|MetaDto|array $metas): void;

	public function updateMeta(MetaDto|array $dto, int $metaId): bool;

	public function deleteMetas(int|array $ids): void;

	public function deleteMeta(int|Meta $id): bool;

	public function incrementMeta(string $metaKey): void;

	public function decrementMeta(string $metaKey): void;

	public function hasMeta(string $metaKey): bool;
}