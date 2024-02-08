<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ClinicMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.clinics.*'),
			'icon' => 'bx bx-clinic',
			'name' => __('admin/clinic.plural'),
			'i18n' => 'Clinics',
			'is_allowed' => Permission::can([
				'clinics.create',
				'clinics.index',
				'clinics.settings',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.clinics.create'),
					'is_active' => $request->routeIs('admin.clinics.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Clinics Create',
					'is_allowed' => Permission::can([
						'clinics.create',
					]),
				]),
				collect([
					'href' => route('admin.clinics.index'),
					'is_active' => $request->routeIs('admin.clinics.index', 'admin.clinics.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Clinics Archive',
					'is_allowed' => Permission::can([
						'clinics.index',
					]),
				]),
				collect([
					'href' => route('admin.clinics.settings.index'),
					'is_active' => $request->routeIs('admin.clinics.settings.index'),
					'name' => __('admin/setting.plural'),
					'i18n' => 'Clinics Settings',
					'is_allowed' => Permission::can([
						'clinics.settings',
					]),
				]),
			]),
		]);
	}
}