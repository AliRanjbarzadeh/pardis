<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\PermissionCategory;
use Illuminate\Support\Collection;

class PermissionService
{
	/**
	 * @return Collection|array|PermissionCategory[]
	 */
	public function categories(): Collection|array
	{
		return PermissionCategory::whereNull('permission_category_id')
			->with([
				'permissions',
				'children' => function ($query) {
					$query->with([
						'permissions',
						'children' => function ($query) {
							$query->with([
								'permissions',
								'children' => function ($query) {
									$query->with('permissions');
								},
							]);
						},
					]);
				},
			])
			->orderBy('priority')
			->get();
	}

	/**
	 * @return Collection|array|Permission[]
	 */
	public function all(): Collection|array
	{
		return Permission::all();
	}
}