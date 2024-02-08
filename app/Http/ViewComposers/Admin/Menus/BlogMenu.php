<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BlogMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.blogs.*', 'admin.categories.blog.*'),
			'icon' => 'bx bxl-blogger',
			'name' => __('admin/blog.plural'),
			'i18n' => 'Blogs',
			'is_allowed' => Permission::can([
				'blogs.create',
				'blogs.index',
				'blogs.categories.create',
				'blogs.categories.index',
				'blogs.comments.index',
				'blogs.settings',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.blogs.create'),
					'is_active' => $request->routeIs('admin.blogs.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Blogs Create',
					'is_allowed' => Permission::can([
						'blogs.create',
					]),
				]),
				collect([
					'href' => route('admin.blogs.index'),
					'is_active' => $request->routeIs('admin.blogs.index', 'admin.blogs.edit', 'admin.blogs.comments.index'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Blogs Archive',
					'is_allowed' => Permission::can([
						'blogs.index',
					]),
				]),
				collect([
					'href' => route('admin.blogs.comments.all.index'),
					'is_active' => $request->routeIs('admin.blogs.comments.all.index'),
					'name' => __('admin/comment.plural'),
					'i18n' => 'Blogs Comments Archive',
					'is_allowed' => Permission::can([
						'blogs.comments.index',
					]),
				]),
				collect([
					'href' => 'javascript:void(0)',
					'is_active' => $request->routeIs('admin.categories.blog.*'),
					'name' => __('admin/category.plural'),
					'i18n' => 'Blog Categories',
					'is_allowed' => Permission::can([
						'blogs.categories.create',
						'blogs.categories.index',
					]),
					'children' => collect([
						collect([
							'href' => route('admin.categories.blog.create'),
							'is_active' => $request->routeIs('admin.categories.blog.create'),
							'name' => __('admin/global.actions.definition'),
							'i18n' => 'Blog Categories Create',
							'is_allowed' => Permission::can([
								'blogs.categories.create',
							]),
						]),
						collect([
							'href' => route('admin.categories.blog.index'),
							'is_active' => $request->routeIs('admin.categories.blog.index', 'admin.categories.blog.edit'),
							'name' => __('admin/global.fields.archive'),
							'i18n' => 'Blog Categories Archive',
							'is_allowed' => Permission::can([
								'blogs.categories.index',
							]),
						]),
					]),
				]),
				collect([
					'href' => route('admin.blogs.settings.index'),
					'is_active' => $request->routeIs('admin.blogs.settings.index'),
					'name' => __('admin/setting.plural'),
					'i18n' => 'Blogs Settings',
					'is_allowed' => Permission::can([
						'blogs.settings',
					]),
				]),
			]),
		]);
	}
}