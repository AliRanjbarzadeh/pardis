<?php

namespace App\Interfaces;

use App\DataTransferObjects\SeoDto;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface SeoInterface
{
	public function seo(): MorphOne;

	public function saveSeoInformation(SeoDto $dto): ?Seo;

	public function updateSeoInformation(SeoDto $dto): bool;
}