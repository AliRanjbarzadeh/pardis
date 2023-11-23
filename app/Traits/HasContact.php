<?php

namespace App\Traits;

use App\DataTransferObjects\ContactDto;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasContact
{
	public function contacts(): MorphMany
	{
		return $this->morphMany(Contact::class, 'model');
	}

	public function addContacts(Collection|array $contacts): void
	{
		$this->contacts()->createMany($this->parseContacts($contacts));
	}

	public function updateContacts(Collection|array $contacts): void
	{
		$parsed = $this->parseContactsUpdate($contacts);

		if (!empty($parsed['ids'])) {
			$this->contacts()->whereNotIn('id', $parsed['ids'])->delete();
		}

		if (!empty($parsed['insert'])) {
			$this->addContacts($parsed['insert']);
		}

		if (!empty($parsed['update'])) {
			foreach ($parsed['update'] as $id => $data) {
				$this->contacts
					->where('id', '=', $id)
					->first()
					->update($data);
			}
		}
	}

	public function deleteContacts(int|array $ids): void
	{
		if (empty($ids)) {
			$this->contacts()->delete();
		} else {
			if (!is_array($ids)) {
				$ids = [$ids];
			}
			$this->contacts()
				->whereIn('id', $ids)
				->delete();
		}
	}

	/*======================Accessors========================*/
	public function getContactsForInputAttribute(): array
	{
		if ($this->contacts->isEmpty()) {
			return [];
		}

		return [
			'id' => $this->contacts->pluck('id')->flatten()->map(fn($id) => 'id-' . $id),
			'title' => $this->contacts->pluck('contact_title')->all(),
			'value' => $this->contacts->pluck('contact_value')->all(),
		];
	}

	/*======================Inner Methods========================*/
	private function parseContacts(Collection|array $contacts): array
	{
		if (is_array($contacts)) {
			if (is_array($contacts[0])) {
				return $contacts;
			}
			$contacts = collect($contacts);
		}

		return $contacts->map(function (ContactDto $dto) {
			return $dto->forCreate();
		})->all();
	}

	private function parseContactsUpdate(Collection|array $contacts): array
	{
		if (is_array($contacts)) {
			$contacts = collect($contacts);
		}

		return [
			'insert' => $contacts->where('id', '=', 0)->all(),
			'update' => $contacts->where('id', '>', 0)->mapWithKeys(function (ContactDto|array $item) {
				if (is_array($item)) {
					return [$item['id'] => Arr::except($item, ['id'])];
				}
				return [$item->id => $item->forCreate()];
			})->all(),
			'ids' => $contacts->where('id', '>', 0)->pluck('id')->all(),
		];
	}
}