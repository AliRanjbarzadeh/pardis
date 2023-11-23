<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/home.singular'),
			'href' => route('index'),
			'is_active' => $request->routeIs('index'),
			'i18n' => 'Home',
		]);
	}
}