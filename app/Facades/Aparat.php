<?php

namespace App\Facades;

use App\Helpers\AparatHelper;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getEmbededLink(string $link)
 *
 * @see \App\Helpers\AparatHelper::getEmbededLink()
 */
class Aparat extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return AparatHelper::class;
	}
}