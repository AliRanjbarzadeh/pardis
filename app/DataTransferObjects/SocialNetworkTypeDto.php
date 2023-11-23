<?php

namespace App\DataTransferObjects;

class SocialNetworkTypeDto
{
	public function __construct(
		public string $name,
		public string $icon,
		public string $linkPattern,
	)
	{
	}

	public function toArray()
	{
		return [
			'name' => $this->name,
			'icon' => $this->icon,
			'link_pattern' => $this->linkPattern,
		];
	}
}