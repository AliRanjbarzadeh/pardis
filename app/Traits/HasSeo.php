<?php

namespace App\Traits;

use App\DataTransferObjects\SeoDto;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasSeo
{
	/**
	 * @return MorphOne
	 */
	public function seo(): MorphOne
	{
		return $this->morphOne(Seo::class, 'model');
	}

	/**
	 * @param SeoDto $dto
	 *
	 * @return Seo|null
	 */
	public function saveSeoInformation(SeoDto $dto): ?Seo
	{
		return $this->seo()->create($dto->toArray());
	}

	/**
	 * @param SeoDto $dto
	 *
	 * @return bool
	 */
	public function updateSeoInformation(SeoDto $dto): bool
	{
		if (empty($this->seo)) {
			return !is_null($this->saveSeoInformation($dto));
		}
		return $this->seo->update($dto->toArray());
	}
}