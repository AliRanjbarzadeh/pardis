<?php

namespace App\Services;

use App\Models\Seo;

class SeoService
{
	public function validation(string $link, string $modelType, ?int $modelId): ?Seo
	{
		$seo = Seo::whereModelType($modelType)
			->whereLink($link);

		if (!is_null($modelId)) {
			$seo->where('model_id', '!=', $modelId);
		}

		return $seo->first();
	}
}