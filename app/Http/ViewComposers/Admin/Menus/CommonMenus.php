<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommonMenus implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			collect([
				'href' => route('admin.about.index'),
				'is_active' => $request->routeIs('admin.about.index'),
				'icon' => 'bx bx-info-circle',
				'name' => __('admin/about.singular'),
				'i18n' => 'About Us',
			]),
			collect([
				'href' => 'javascript:void(0);',
				'is_active' => $request->routeIs('admin.contacts.*'),
				'icon' => 'bx bxs-contact',
				'name' => __('admin/contact.singular'),
				'i18n' => 'Contact Us',
				'children' => collect([
					collect([
						'href' => route('admin.contacts.index'),
						'is_active' => $request->routeIs('admin.contacts.index', 'admin.contacts.show'),
						'name' => __('admin/contact.fields.form.archive'),
						'i18n' => 'Contacts Archive',
					]),
					collect([
						'href' => route('admin.contacts.settings.index'),
						'is_active' => $request->routeIs('admin.contacts.settings.index'),
						'name' => __('admin/setting.singular'),
						'i18n' => 'Contacts Setting',
					]),
				]),
			]),
			collect([
				'href' => 'javascript:void(0);',
				'is_active' => $request->routeIs('admin.footer.*'),
				'icon' => 'bx bx-cog',
				'name' => __('admin/setting.singular'),
				'i18n' => 'Settings',
				'children' => collect([
					collect([
						'href' => route('admin.footer.settings.index'),
						'is_active' => $request->routeIs('admin.footer.settings.index'),
						'name' => __('admin/setting.words.footer.singular'),
						'i18n' => 'Settings Footer',
					]),
				]),
			]),
		]);
	}
}