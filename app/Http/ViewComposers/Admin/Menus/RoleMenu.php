<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RoleMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.roles.*'),
			'icon' => 'bx bxs-user-account',
			'name' => __('admin/role.plural'),
			'i18n' => 'Roles',
			'is_allowed' => Permission::can([
				'roles.index',
				'roles.create',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.roles.create'),
					'is_active' => $request->routeIs('admin.roles.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Roles Create',
					'is_allowed' => Permission::can([
						'roles.create',
					]),
				]),
				collect([
					'href' => route('admin.roles.index'),
					'is_active' => $request->routeIs('admin.roles.index', 'admin.roles.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Roles Archive',
					'is_allowed' => Permission::can([
						'roles.index',
					]),
				]),
			]),
		]);
	}
}