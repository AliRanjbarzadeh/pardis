<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool can(string|array $permissionType)
 *
 * @see \App\Helpers\PermissionHelper::can()
 */
class Permission extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return 'permission';
	}
}