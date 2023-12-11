<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AparatHelper
{
	private function getBaseUrl($path): string
	{
		return "https://www.aparat.com/$path";
	}

	public function getEmbededLink(string $link): string
	{
		$videoId = Str::afterLast($link, '/');
		return $this->getBaseUrl("embed/$videoId");
	}
}