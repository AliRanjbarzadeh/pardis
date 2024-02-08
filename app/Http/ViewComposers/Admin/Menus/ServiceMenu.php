<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServiceMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.services.*'),
			'icon' => 'bx bx-wrench',
			'name' => __('admin/service.plural'),
			'i18n' => 'Services',
			'is_allowed' => Permission::can([
				'services.create',
				'services.index',
				'services.settings',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.services.create'),
					'is_active' => $request->routeIs('admin.services.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Services Create',
					'is_allowed' => Permission::can([
						'services.create',
					]),
				]),
				collect([
					'href' => route('admin.services.index'),
					'is_active' => $request->routeIs('admin.services.index', 'admin.services.edit', 'admin.services.comments.index'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Services Archive',
					'is_allowed' => Permission::can([
						'services.index',
					]),
				]),
//				collect([
//					'href' => route('admin.services.comments.all.index'),
//					'is_active' => $request->routeIs('admin.services.comments.all.index'),
//					'name' => __('admin/comment.plural'),
//					'i18n' => 'Services Comments Archive',
//				]),
				collect([
					'href' => route('admin.services.settings.index'),
					'is_active' => $request->routeIs('admin.services.settings.index'),
					'name' => __('admin/setting.plural'),
					'i18n' => 'Services Settings',
					'is_allowed' => Permission::can([
						'services.settings',
					]),
				]),
			]),
		]);
	}
}