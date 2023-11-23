<?php

namespace App\Interfaces;

use App\DataTransferObjects\RateDto;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface RateInterface
{
	public function rates(): MorphMany;

	public function addRates(Collection|array|RateDto $rates): void;

	public function updateRate(RateDto|array $dto, Rate $rate): bool;

	public function deleteRates(int|array $ids): void;
}