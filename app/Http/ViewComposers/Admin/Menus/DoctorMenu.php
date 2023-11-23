<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DoctorMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.doctors.*'),
			'icon' => 'bx bx-user-plus',
			'name' => __('admin/doctor.plural'),
			'i18n' => 'Doctors',
			'children' => collect([
				collect([
					'href' => route('admin.doctors.create'),
					'is_active' => $request->routeIs('admin.doctors.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Doctors Create',
				]),
				collect([
					'href' => route('admin.doctors.index'),
					'is_active' => $request->routeIs('admin.doctors.index', 'admin.doctors.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Doctors Archive',
				]),
				collect([
					'href' => route('admin.doctors.comments.all.index'),
					'is_active' => $request->routeIs('admin.doctors.comments.all.index'),
					'name' => __('admin/comment.plural'),
					'i18n' => 'Doctors Comments Archive',
				]),
				collect([
					'href' => route('admin.doctors.settings.index'),
					'is_active' => $request->routeIs('admin.doctors.settings.index'),
					'name' => __('admin/setting.plural'),
					'i18n' => 'Doctors Settings',
				]),
			]),
		]);
	}
}