<?php

namespace App\Facades;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Medium upload(UploadedFile $file, string $path = '')
 * @method static void remove(array|int $ids)
 * @method static string url(string $path)
 * @method static void setSizes(array $sizes)
 *
 * @see \App\Helpers\MediumHelper::upload()
 * @see \App\Helpers\MediumHelper::remove()
 * @see \App\Helpers\MediumHelper::setSizes()
 */
class Media extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return 'media';
	}
}