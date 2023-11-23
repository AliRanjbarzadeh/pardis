<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServiceMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/service.words.menu.title'),
			'href' => route('services.index'),
			'is_active' => $request->routeIs('services.*'),
			'i18n' => 'Service',
		]);
	}
}