<?php

namespace App\Traits;

use App\DataTransferObjects\SocialNetworkDto;
use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasSocialNetwork
{
	public function socialNetworks(): MorphMany
	{
		return $this->morphMany(SocialNetwork::class, 'model');
	}

	public function addSocialNetworks(Collection|SocialNetworkDto|array $socialNetworks): void
	{
		$this->socialNetworks()->createMany($this->parseSocialNetworks($socialNetworks));
	}

	public function updateSocialNetworks(Collection|SocialNetworkDto|array $socialNetworks): void
	{
		$parsed = $this->parseSocialNetworksUpdate($socialNetworks);

		if (!empty($parsed['ids'])) {
			$this->socialNetworks()->whereNotIn('id', $parsed['ids'])->delete();
		}

		if (!empty($parsed['insert'])) {
			$this->addSocialNetworks($parsed['insert']);
		}

		if (!empty($parsed['update'])) {
			foreach ($parsed['update'] as $id => $data) {
				$this->socialNetworks
					->where('id', '=', $id)
					->first()
					->update($data);
			}
		}
	}

	public function deleteSocialNetworks(int|array $ids): void
	{
		if (empty($ids)) {
			$this->socialNetworks()->delete();
		}
		if (!is_array($ids)) {
			$ids = [$ids];
		}
		$this->socialNetworks()
			->whereIn('id', $ids)
			->delete();
	}

	/*======================Accessors========================*/
	public function getSocialNetworksForInputAttribute(): array
	{
		if ($this->socialNetworks->isEmpty()) {
			return [];
		}

		return [
			'id' => $this->socialNetworks->pluck('id')->flatten()->map(fn($id) => 'id-' . $id),
			'title' => $this->socialNetworks->pluck('title')->all(),
			'address' => $this->socialNetworks->pluck('address')->all(),
			'type_id' => $this->socialNetworks->pluck('social_network_type_id')->all(),
		];
	}

	/*======================Inner Methods========================*/
	private function parseSocialNetworks(Collection|SocialNetworkDto|array $socialNetworks): array
	{
		if ($socialNetworks instanceof SocialNetworkDto) {
			return [$socialNetworks->forCreate()];
		}

		if (is_array($socialNetworks)) {
			$socialNetworks = collect($socialNetworks);
		}

		return $socialNetworks->map(function (SocialNetworkDto|array $item) {
			if (is_array($item)) {
				return Arr::except($item, ['id']);
			}

			return $item->forCreate();
		})->all();
	}

	private function parseSocialNetworksUpdate(Collection|SocialNetworkDto|array $socialNetworks): array
	{
		if ($socialNetworks instanceof SocialNetworkDto) {
			return [$socialNetworks->id => $socialNetworks->forCreate()];
		}

		if (is_array($socialNetworks)) {
			$socialNetworks = collect($socialNetworks);
		}

		return [
			'insert' => $socialNetworks->where('id', '=', 0)->all(),
			'update' => $socialNetworks->where('id', '>', 0)->mapWithKeys(function (SocialNetworkDto|array $item) {
				if (is_array($item)) {
					return [$item['id'] => Arr::except($item, ['id'])];
				}
				return [$item->id => $item->forCreate()];
			})->all(),
			'ids' => $socialNetworks->where('id', '>', 0)->pluck('id')->all(),
		];
	}
}