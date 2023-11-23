<?php

namespace App\Services;

use App\DataTransferObjects\SettingDto;
use App\Models\Setting;
use Illuminate\Support\Collection;

class SettingService
{
	public function updateOrCreate(SettingDto|Collection|array $settings): void
	{
		if ($settings instanceof SettingDto) {
			Setting::updateOrCreate(['setting_key' => $settings->settingKey], $settings->toArray());
		} else {
			if (is_array($settings)) {
				$settings = collect($settings);
			}

			$settings->map(function (SettingDto $dto) {
				Setting::updateOrCreate(['setting_key' => $dto->settingKey], $dto->toArray());
			});
		}
	}

	public function all()
	{
		return Setting::all();
	}
}