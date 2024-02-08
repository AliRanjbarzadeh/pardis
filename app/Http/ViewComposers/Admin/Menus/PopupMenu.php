<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PopupMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.popups.*'),
			'icon' => 'bx bx-windows',
			'name' => __('admin/popup.plural'),
			'i18n' => 'Popups',
			'is_allowed' => Permission::can([
				'popups.create',
				'popups.index',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.popups.create'),
					'is_active' => $request->routeIs('admin.popups.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Popups Create',
					'is_allowed' => Permission::can([
						'popups.create',
					]),
				]),
				collect([
					'href' => route('admin.popups.index'),
					'is_active' => $request->routeIs('admin.popups.index', 'admin.popups.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Popups Archive',
					'is_allowed' => Permission::can([
						'popups.index',
					]),
				]),
			]),
		]);
	}
}