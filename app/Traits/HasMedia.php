<?php

namespace App\Traits;

use App\DataTransferObjects\MediaDto;
use App\Exceptions\MediaException;
use App\Facades\Media;
use App\Models\Medium;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

trait HasMedia
{
	/**
	 * @param string|UploadedFile $file
	 * @param string $name
	 *
	 * @return Medium
	 * @throws MediaException
	 */
	public function upload(string|UploadedFile $file, string $name): Medium
	{
		if (is_string($file)) {
			$file = request()->file($file);
		}

		//set sizes
		Media::setSizes($this->getSizes());

		//upload media
		$medium = Media::upload($file);

		//attach media to model
		$this->addMedia(new MediaDto(mediumId: $medium->id, name: $name));

		return $medium;
	}

	/**
	 * @return MorphToMany
	 */
	public function media(): MorphToMany
	{
		return $this->morphToMany(
			Medium::class,
			'model',
			'medium_items',
		)->withPivot('name', 'id')->withTimestamps();
	}

	/**
	 * @param Collection|MediaDto $media
	 *
	 * @return void
	 * @throws MediaException
	 */
	public function addMedia(Collection|MediaDto $media): void
	{
		$mediaIds = $this->parseMedia($media);
		$this->media()->attach($mediaIds);
	}

	/**
	 * @param Collection|MediaDto $media
	 *
	 * @return array
	 * @throws MediaException
	 */
	public function updateMedia(Collection|MediaDto $media): array
	{
		$mediaIds = $this->parseMedia($media);
		return $this->media()->sync($mediaIds);
	}

	/**
	 * @param int|array $ids
	 *
	 * @return void
	 * @throws MediaException
	 */
	public function removeMedia(int|array $ids): void
	{
		if (empty($ids)) {
			throw new MediaException("no id provided");
		}

		if (is_int($ids)) {
			$ids = [$ids];
		}

		$this->media()->detach($ids);
	}

	/**
	 * @return Collection
	 */
	public function getMedia(array $ids): Collection
	{
		return $this->media->whereIn('pivot.id', $ids);
	}

	/**
	 * @param array|string $names
	 *
	 * @return Collection
	 */
	public function getMediaByNames(array|string $names): Collection
	{
		if (empty($names)) {
			return $this->media;
		}

		if (!is_array($names)) {
			$names = [$names];
		}

		return $this->media->whereIn('pivot.name', $names);
	}

	public function getMedium(int $id): ?Medium
	{
		return $this->media->where('pivot.id', '=', $id)->first();
	}

	public function getMediumByName(string $name): ?Medium
	{
		if (empty($name)) {
			throw new MediaException('no name provided to search');
		}
		return $this->media->where('pivot.name', '=', $name)->first();
	}

	/**
	 * @return array
	 */
	public function getSizes(): array
	{
		return config('media.sub_sizes');
	}

	/*======================Accessors========================*/
	public function getFeatureImageAttribute(): ?Medium
	{
		return $this->getMediumByName('featureImage');
	}

	/*======================Inner Methods========================*/
	/**
	 * @param Collection|MediaDto $media
	 *
	 * @throws MediaException
	 */
	private function parseMedia($media): array
	{
		if ($media instanceof MediaDto) {
			return [$media->mediumId => ['name' => $media->name]];
		}

		if ($media->isEmpty()) {
			throw new MediaException('No media provided');
		}

		return $media->mapWithKeys(function (MediaDto $item) {
			return [$item->mediumId => ['name' => $item->name]];
		})->toArray();
	}
}