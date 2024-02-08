<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SettingsMenus implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			//Separator
			SeparatorMenu::getMenu($request, __('admin/setting.plural')),

			collect([
				'href' => 'javascript:void(0);',
				'is_active' => $request->routeIs('admin.footer.*'),
				'icon' => 'bx bx-cog',
				'name' => __('admin/setting.words.public'),
				'i18n' => 'Settings',
				'is_allowed' => Permission::can([
					'settings.footer',
				]),
				'children' => collect([
					collect([
						'href' => route('admin.footer.settings.index'),
						'is_active' => $request->routeIs('admin.footer.settings.index'),
						'name' => __('admin/setting.words.footer.singular'),
						'i18n' => 'Settings Footer',
						'is_allowed' => Permission::can([
							'settings.footer',
						]),
					]),
				]),
			]),
		]);
	}
}