<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface ContactInterface
{
	public function contacts(): MorphMany;

	public function addContacts(Collection|array $faqs): void;

	public function updateContacts(Collection|array $faqs): void;

	public function deleteContacts(int|array $ids): void;
}