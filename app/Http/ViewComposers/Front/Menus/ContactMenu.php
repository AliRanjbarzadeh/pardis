<?php

namespace App\Http\ViewComposers\Front\Menus;

use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ContactMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'name' => __('front/global.words.contact_us.menu.title'),
			'href' => route('contact.index'),
			'is_active' => $request->routeIs('contact.index'),
			'i18n' => 'Contact Us',
		]);
	}
}