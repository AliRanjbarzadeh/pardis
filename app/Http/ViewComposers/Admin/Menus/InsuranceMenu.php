<?php

namespace App\Http\ViewComposers\Admin\Menus;


use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InsuranceMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.insurances.*', 'admin.categories.insurance.*'),
			'icon' => 'bx bx-check-shield',
			'name' => __('admin/insurance.plural'),
			'i18n' => 'Insurances',
			'is_allowed' => Permission::can([
				'insurances.index',
				'insurances.create',
				'insurances.categories.create',
				'insurances.categories.index',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.insurances.create'),
					'is_active' => $request->routeIs('admin.insurances.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Insurances Create',
					'is_allowed' => Permission::can([
						'insurances.create',
					]),
				]),
				collect([
					'href' => route('admin.insurances.index'),
					'is_active' => $request->routeIs('admin.insurances.index', 'admin.insurances.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Insurances Archive',
					'is_allowed' => Permission::can([
						'insurances.index',
					]),
				]),
				collect([
					'href' => 'javascript:void(0)',
					'is_active' => $request->routeIs('admin.categories.insurance.*'),
					'name' => __('admin/category.plural'),
					'i18n' => 'Insurance Categories',
					'is_allowed' => Permission::can([
						'insurances.categories.create',
						'insurances.categories.index',
					]),
					'children' => collect([
						collect([
							'href' => route('admin.categories.insurance.create'),
							'is_active' => $request->routeIs('admin.categories.insurance.create'),
							'name' => __('admin/global.actions.definition'),
							'i18n' => 'Insurance Categories Create',
							'is_allowed' => Permission::can([
								'insurances.categories.create',
							]),
						]),
						collect([
							'href' => route('admin.categories.insurance.index'),
							'is_active' => $request->routeIs('admin.categories.insurance.index', 'admin.categories.insurance.children.*'),
							'name' => __('admin/global.fields.archive'),
							'i18n' => 'Insurance Categories Archive',
							'is_allowed' => Permission::can([
								'insurances.categories.index',
							]),
						]),
					]),
				]),
			]),
		]);
	}
}