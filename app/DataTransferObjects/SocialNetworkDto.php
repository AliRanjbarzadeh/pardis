<?php

namespace App\DataTransferObjects;

class SocialNetworkDto
{
	public function __construct(
		public int    $socialNetworkTypeId,
		public string $title,
		public string $address,
		public int    $id = 0,
		public int    $priority = 0,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'social_network_type_id' => $this->socialNetworkTypeId,
			'title' => $this->title,
			'address' => $this->address,
			'priority' => $this->priority,
		];
	}

	public function forCreate(): array
	{
		return [
			'social_network_type_id' => $this->socialNetworkTypeId,
			'title' => $this->title,
			'address' => $this->address,
			'priority' => $this->priority,
		];
	}
}