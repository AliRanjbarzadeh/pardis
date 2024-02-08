<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.home.*'),
			'icon' => 'bx bx-home-alt-2',
			'name' => __('admin/page.words.home'),
			'i18n' => 'Home',
			'is_allowed' => Permission::can([
				'home.settings',
				'home.sliders.create',
				'home.sliders.index',
			]),
			'children' => collect([
				collect([
					'href' => 'javascript:void(0)',
					'is_active' => $request->routeIs('admin.home.sliders.*'),
					'name' => __('admin/slider.plural'),
					'i18n' => 'Home Sliders',
					'is_allowed' => Permission::can([
						'home.sliders.create',
						'home.sliders.index',
					]),
					'children' => collect([
						collect([
							'href' => route('admin.home.sliders.create'),
							'is_active' => $request->routeIs('admin.home.sliders.create'),
							'name' => __('admin/global.actions.definition'),
							'i18n' => 'Home Sliders Create',
							'is_allowed' => Permission::can([
								'home.sliders.create',
							]),
						]),
						collect([
							'href' => route('admin.home.sliders.index'),
							'is_active' => $request->routeIs('admin.home.sliders.index', 'admin.home.sliders.edit'),
							'name' => __('admin/global.fields.archive'),
							'i18n' => 'Home Sliders Archive',
							'is_allowed' => Permission::can([
								'home.sliders.index',
							]),
						]),
					]),
				]),
				collect([
					'href' => route('admin.home.settings.index'),
					'is_active' => $request->routeIs('admin.home.settings.index'),
					'name' => __('admin/setting.plural'),
					'i18n' => 'Home Settings',
					'is_allowed' => Permission::can([
						'home.settings',
					]),
				]),
			]),
		]);
	}
}