<?php

namespace App\Http\ViewComposers\Admin\Menus;

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
			'children' => collect([
				collect([
					'href' => route('admin.services.create'),
					'is_active' => $request->routeIs('admin.services.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Services Create',
				]),
				collect([
					'href' => route('admin.services.index'),
					'is_active' => $request->routeIs('admin.services.index', 'admin.services.edit', 'admin.services.comments.index'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Services Archive',
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
				]),
			]),
		]);
	}
}