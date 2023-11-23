<?php

namespace App\DataTransferObjects;

class InsuranceItemDto
{
	public function __construct(
		public int $insuranceId,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'insurance_id' => $this->insuranceId,
		];
	}
}