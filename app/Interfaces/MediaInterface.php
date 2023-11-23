<?php

namespace App\Interfaces;

use App\DataTransferObjects\MediaDto;
use App\Models\Medium;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface MediaInterface
{
	public function upload(UploadedFile $file, string $name): Medium;

	public function media(): MorphToMany;

	public function addMedia(Collection|MediaDto $media): void;

	public function updateMedia(Collection|MediaDto $media): array;

	public function removeMedia(int|array $ids): void;

	public function getMedia(array $ids): Collection;

	public function getMediaByNames(array $names): Collection;

	public function getMedium(int $id): ?Medium;

	public function getMediumByName(string $name): ?Medium;

	public function getSizes(): array;
}