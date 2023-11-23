<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SpecialityMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.specialities.*'),
			'icon' => 'bx bxs-capsule',
			'name' => __('admin/speciality.plural'),
			'i18n' => 'Specialities',
			'children' => collect([
				collect([
					'href' => route('admin.specialities.create'),
					'is_active' => $request->routeIs('admin.specialities.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Speciality Create',
				]),
				collect([
					'href' => route('admin.specialities.index'),
					'is_active' => $request->routeIs('admin.specialities.index', 'admin.specialities.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Speciality Archive',
				]),
			]),
		]);
	}
}