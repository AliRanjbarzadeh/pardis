<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GalleryMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.galleries.*', 'admin.categories.gallery.*'),
			'icon' => 'bx bx-images',
			'name' => __('admin/gallery.plural'),
			'i18n' => 'Blogs',
			'children' => collect([
				collect([
					'href' => route('admin.galleries.create'),
					'is_active' => $request->routeIs('admin.galleries.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Galleries Create',
				]),
				collect([
					'href' => route('admin.galleries.index'),
					'is_active' => $request->routeIs('admin.galleries.index', 'admin.galleries.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Galleries Archive',
				]),
				collect([
					'href' => 'javascript:void(0)',
					'is_active' => $request->routeIs('admin.categories.gallery.*'),
					'name' => __('admin/category.plural'),
					'i18n' => 'Gallery Categories',
					'children' => collect([
						collect([
							'href' => route('admin.categories.gallery.create'),
							'is_active' => $request->routeIs('admin.categories.gallery.create'),
							'name' => __('admin/global.actions.definition'),
							'i18n' => 'Gallery Categories Create',
						]),
						collect([
							'href' => route('admin.categories.gallery.index'),
							'is_active' => $request->routeIs('admin.categories.gallery.index', 'admin.categories.gallery.edit'),
							'name' => __('admin/global.fields.archive'),
							'i18n' => 'Gallery Categories Archive',
						]),
					]),
				]),
			]),
		]);
	}
}