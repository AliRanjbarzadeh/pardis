<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AboutMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/global.words.about_us.menu.title'),
			'href' => route('about'),
			'is_active' => $request->routeIs('about'),
			'i18n' => 'About Us',
		]);
	}
}