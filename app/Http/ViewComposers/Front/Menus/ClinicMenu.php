<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ClinicMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/clinic.words.menu.title'),
			'href' => route('clinics.index'),
			'is_active' => $request->routeIs('clinics.*'),
			'i18n' => 'Clinic',
		]);
	}
}