<?php

namespace App\Interfaces;

use App\DataTransferObjects\SocialNetworkDto;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface SocialNetworkInterface
{
	public function socialNetworks(): MorphMany;

	public function addSocialNetworks(Collection|SocialNetworkDto|array $socialNetworks): void;

	public function updateSocialNetworks(Collection|SocialNetworkDto|array $socialNetworks): void;

	public function deleteSocialNetworks(int|array $ids): void;
}