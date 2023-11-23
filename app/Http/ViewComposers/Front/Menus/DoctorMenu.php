<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DoctorMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/doctor.words.menu.title'),
			'href' => route('doctors.index'),
			'is_active' => $request->routeIs('doctors.*'),
			'i18n' => 'Doctor',
		]);
	}
}