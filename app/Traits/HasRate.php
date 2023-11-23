<?php

namespace App\Traits;

use App\DataTransferObjects\RateDto;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasRate
{
	public function rates(): MorphMany
	{
		return $this->morphMany(Rate::class, 'model');
	}

	public function addRates(Collection|array|RateDto $rates): void
	{
		$this->rates()->createMany($this->parseRates($rates));
	}

	public function updateRate(RateDto|array $dto, Rate $rate): bool
	{
		return $rate->update($this->parseRate($dto));
	}

	public function deleteRates(int|array $ids): void
	{
		if (empty($ids)) {
			$this->rates()->delete();
		} else {
			if (!is_array($ids)) {
				$ids = [$ids];
			}
			$this->rates()->whereIn('id', $ids)->delete();
		}
	}

	/*======================Inner Methods========================*/
	private function parseRates(Collection|array|RateDto $rates): array
	{
		if ($rates instanceof RateDto) {
			return [$rates->toArray()];
		}

		if (is_array($rates)) {
			$rates = collect($rates);
		}

		return $rates->map(function (RateDto|array $item) {
			if (is_array($item)) {
				return $item;
			}
			return $item->toArray();
		})->all();
	}

	private function parseRate(RateDto|array $dto): array
	{
		if (is_array($dto)) {
			return $dto;
		}

		return $dto->toArray();
	}
}