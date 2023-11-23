<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface FaqInterface
{
	public function faqs(): MorphMany;

	public function addFaqs(Collection|array $faqs): void;

	public function updateFaqs(Collection|array $faqs): void;

	public function deleteFaqs(int|array $ids): void;
}