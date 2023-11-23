<?php

namespace App\DataTransferObjects;

class RateDto
{
	public function __construct(
		public int     $rateValue,
		public ?int    $userId = null,
		public ?string $userAgentInfo = null,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'rate_value' => $this->rateValue,
			'user_id' => $this->userId,
			'user_agent_info' => $this->userAgentInfo,
		];
	}
}