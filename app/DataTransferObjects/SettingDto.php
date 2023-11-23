<?php

namespace App\DataTransferObjects;

class SettingDto extends BaseDto
{
	public function __construct(
		public string $settingKey,
		public mixed $settingValue,
	)
	{
	}

	public function toArray(): array
	{
		return [
			'setting_key' => $this->settingKey,
			'setting_value' => $this->settingValue,
		];
	}
}