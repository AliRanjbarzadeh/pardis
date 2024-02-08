<?php

namespace App\Helpers;

use App\Models\Admin;

class PermissionHelper
{
	protected Admin $admin;

	public function __construct()
	{
		$this->admin = request()->user();
	}

	/**
	 * @param string $permissionType
	 *
	 * @return bool
	 */
	public function can(string|array $permissionType): bool
	{
		if ($this->admin->is_super_admin == 1) {
			return true;
		}

		if (is_string($permissionType)) {
			return $this->admin->hasPermission($permissionType);
		}

		if (is_array($permissionType)) {
			foreach ($permissionType as $value) {
				if ($this->admin->hasPermission($value) ?? false) {
					return true;
				}
			}
		}

		return false;
	}
}
