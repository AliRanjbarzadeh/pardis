<?php

namespace App\DataTransferObjects;

class ContactDto
{
	public function __construct(
		public int    $id,
		public string $contactTitle,
		public string $contactValue,
		public string $contactType = 'tell',
	)
	{
		if (filter_var($this->contactValue, FILTER_VALIDATE_EMAIL)) {
			$this->contactType = 'email';
		}
		if (filter_var($this->contactValue, FILTER_VALIDATE_URL)) {
			$this->contactType = 'url';
		}
	}

	public function forCreate(): array
	{
		return [
			'contact_title' => $this->contactTitle,
			'contact_value' => $this->contactValue,
			'contact_type' => $this->contactType,
		];
	}
}