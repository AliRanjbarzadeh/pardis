<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InsuranceMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/insurance.words.menu.title'),
			'href' => route('insurances.index'),
			'is_active' => $request->routeIs('insurances.*'),
			'i18n' => 'Insurance',
		]);
	}
}