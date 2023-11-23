<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BlogMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/blog.words.menu.title'),
			'href' => route('blogs.index'),
			'is_active' => $request->routeIs('blogs.*'),
			'i18n' => 'Blog',
		]);
	}
}