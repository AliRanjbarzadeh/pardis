<?php

namespace Database\Seeders;

use App\Models\PermissionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
	protected int $priority = 1;

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = config('permissions');

		DB::beginTransaction();
		foreach ($categories as $category) {
			$this->savePermissionCategory($category);
		}
		DB::commit();
	}

	private function getPriority(): int
	{
		$mCurrent = $this->priority;
		$this->priority += 1;
		return $mCurrent;
	}

	private function saveRelatedPermission(PermissionCategory $permissionCategory, array $relatedPermissions): void
	{
		foreach ($relatedPermissions as $relatedKey => $relatedPermission) {
			try {
				if (is_string($relatedPermission)) {
					dd($relatedPermissions);
				}
				$newCategory = [
					'name' => $relatedPermission['name'],
					'permissions' => [
						$permissionCategory->type_dot . $relatedKey => $relatedPermission['permissions'],
					],
				];

				if (isset($relatedPermission['related_permissions'])) {
					$newCategory['permissions']['related_permissions'] = $relatedPermission['related_permissions'];
				}

				$this->savePermissionCategory($newCategory, $permissionCategory);
			} catch (\Exception $e) {
				dd($e->getMessage(), $relatedPermission);
			}
		}
	}

	private function savePermissionCategory(array $category, ?PermissionCategory $parent = null): void
	{
		$permissionCategory = PermissionCategory::where('name', '=', $category['name'])
			->wherePermissionCategoryId($parent?->id)
			->first();

		if (is_null($permissionCategory)) {
			$permissionCategory = PermissionCategory::create([
				'name' => $category['name'],
				'priority' => is_null($parent) ? $this->getPriority() : 0,
				'type' => array_key_first($category['permissions']),
				'permission_category_id' => $parent?->id,
			]);
		} else {
			$permissionCategory->update([
				'priority' => is_null($parent) ? $this->getPriority() : 0,
			]);
		}

		$this->savePermissions($permissionCategory, Arr::dot(Arr::except($category['permissions'], ['related_permissions'])));
		if (isset($category['permissions']['related_permissions'])) {
			$this->saveRelatedPermission($permissionCategory, $category['permissions']['related_permissions']);
		}
	}

	private function savePermissions(PermissionCategory $permissionCategory, array $permissions): void
	{
		foreach ($permissions as $permKey => $permName) {
			$permission = $permissionCategory->permissions()
				->where('type', '=', $permKey)
				->first();

			if (is_null($permission)) {
				$permissionCategory->permissions()->create([
					'name' => $permName,
					'type' => $permKey,
				]);
			} else {
				$permission->update([
					'name' => $permName,
				]);
			}
		}
	}
}
