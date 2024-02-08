<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PagesMenus implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			//Separator
			SeparatorMenu::getMenu($request, __('admin/page.plural')),

			//Home
			HomeMenu::getMenu($request),

			collect([
				'href' => route('admin.about.index'),
				'is_active' => $request->routeIs('admin.about.index'),
				'icon' => 'bx bx-info-circle',
				'name' => __('admin/about.singular'),
				'i18n' => 'About Us',
				'is_allowed' => Permission::can([
					'about.edit',
				]),
			]),
			collect([
				'href' => 'javascript:void(0);',
				'is_active' => $request->routeIs('admin.contacts.*'),
				'icon' => 'bx bxs-contact',
				'name' => __('admin/contact.singular'),
				'i18n' => 'Contact Us',
				'is_allowed' => Permission::can([
					'contacts.index',
					'contacts.settings',
				]),
				'children' => collect([
					collect([
						'href' => route('admin.contacts.index'),
						'is_active' => $request->routeIs('admin.contacts.index', 'admin.contacts.show'),
						'name' => __('admin/contact.fields.form.archive'),
						'i18n' => 'Contacts Archive',
						'is_allowed' => Permission::can([
							'contacts.index',
						]),
					]),
					collect([
						'href' => route('admin.contacts.settings.index'),
						'is_active' => $request->routeIs('admin.contacts.settings.index'),
						'name' => __('admin/setting.singular'),
						'i18n' => 'Contacts Setting',
						'is_allowed' => Permission::can([
							'contacts.settings',
						]),
					]),
				]),
			]),
		]);
	}
}