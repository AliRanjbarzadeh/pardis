<?php

namespace App\Http\ViewComposers\Front;


use App\Http\ViewComposers\Front\Menus\AboutMenu;
use App\Http\ViewComposers\Front\Menus\BlogMenu;
use App\Http\ViewComposers\Front\Menus\ClinicMenu;
use App\Http\ViewComposers\Front\Menus\ContactMenu;
use App\Http\ViewComposers\Front\Menus\DoctorMenu;
use App\Http\ViewComposers\Front\Menus\HomeMenu;
use App\Http\ViewComposers\Front\Menus\InsuranceMenu;
use App\Http\ViewComposers\Front\Menus\ServiceMenu;
use Illuminate\View\View;

class NavbarMenuComposer
{
	public function __construct()
	{
	}

	public function compose(View $view): void
	{
		$request = request();

		$menus = collect([
			//Home
			HomeMenu::getMenu($request),

			//Service
			ServiceMenu::getMenu($request),

			//Clinic
			ClinicMenu::getMenu($request),

			//Doctor
			DoctorMenu::getMenu($request),

			//Insurance
			InsuranceMenu::getMenu($request),

			//Blog
			BlogMenu::getMenu($request),

			//About Us
			AboutMenu::getMenu($request),

			//Contact Us
			ContactMenu::getMenu($request),
		]);

		$view->with('menus', $menus);
	}
}