<?php

namespace App\Traits;

use App\DataTransferObjects\FaqDto;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasFaq
{
	public function faqs(): MorphMany
	{
		return $this->morphMany(Faq::class, 'model');
	}

	public function addFaqs(Collection|array $faqs): void
	{
		$this->faqs()->createMany($this->parseFaqs($faqs));
	}

	public function updateFaqs(Collection|array $faqs): void
	{
		$parsed = $this->parseFaqsUpdate($faqs);

		if (!empty($parsed['ids'])) {
			$this->faqs()->whereNotIn('id', $parsed['ids'])->delete();
		}

		if (!empty($parsed['insert'])) {
			$this->addFaqs($parsed['insert']);
		}

		if (!empty($parsed['update'])) {
			foreach ($parsed['update'] as $id => $data) {
				$this->faqs()
					->where('id', '=', $id)
					->update($data);
			}
		}
	}

	public function deleteFaqs(int|array $ids): void
	{
		if (empty($ids)) {
			$this->faqs()->delete();
		} else {
			if (!is_array($ids)) {
				$ids = [$ids];
			}
			$this->faqs()->whereIn('id', $ids)->delete();
		}
	}

	/*======================Accessors========================*/
	public function getFaqsForInputAttribute(): array
	{
		if ($this->faqs->isEmpty()) {
			return [];
		}

		return [
			'id' => $this->faqs->pluck('id')->flatten()->map(fn($id) => 'id-' . $id),
			'question' => $this->faqs->pluck('question')->all(),
			'answer' => $this->faqs->pluck('answer')->all(),
		];
	}

	/*======================Inner Methods========================*/
	private function parseFaqs(Collection|array $faqs): array
	{
		if (is_array($faqs)) {
			if (is_array($faqs[0])) {
				return $faqs;
			}
			$faqs = collect($faqs);
		}

		return $faqs->map(function (FaqDto $dto) {
			return $dto->forCreate();
		})->all();
	}

	private function parseFaqsUpdate(Collection|array $faqs): array
	{
		if (is_array($faqs)) {
			$faqs = collect($faqs);
		}

		return [
			'insert' => $faqs->where('id', '=', 0)->values(),
			'update' => $faqs->where('id', '>', 0)->mapWithKeys(function (array|FaqDto $item) {
				if (is_array($item)) {
					return [$item['id'] => Arr::except($item, ['id'])];
				}
				return [$item->id => $item->forCreate()];
			})->all(),
			'ids' => $faqs->where('id', '>', 0)->pluck('id')->all(),
		];
	}
}