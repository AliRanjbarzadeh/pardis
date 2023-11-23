<?php

namespace App\Http\ViewComposers\Admin;

use App\Http\ViewComposers\Admin\Menus\BlogMenu;
use App\Http\ViewComposers\Admin\Menus\ClinicMenu;
use App\Http\ViewComposers\Admin\Menus\CommonMenus;
use App\Http\ViewComposers\Admin\Menus\CommunicationMenu;
use App\Http\ViewComposers\Admin\Menus\DoctorMenu;
use App\Http\ViewComposers\Admin\Menus\GalleryMenu;
use App\Http\ViewComposers\Admin\Menus\HomeMenu;
use App\Http\ViewComposers\Admin\Menus\InsuranceMenu;
use App\Http\ViewComposers\Admin\Menus\SeparatorMenu;
use App\Http\ViewComposers\Admin\Menus\ServiceMenu;
use App\Http\ViewComposers\Admin\Menus\SpecialityMenu;
use App\Http\ViewComposers\Admin\Menus\TestimonialMenu;
use Illuminate\View\View;

class SideMenuComposer
{
	public function __construct()
	{
	}

	public function compose(View $view): void
	{
		$request = request();

		$menus = collect([
			//Dashboard
			collect([
				'href' => route('admin.index'),
				'is_active' => $request->is('admin'),
				'icon' => 'bx bxs-dashboard',
				'name' => __('admin/dashboard.singular'),
				'i18n' => 'Dashboard',
			]),

			//Separator
			SeparatorMenu::getMenu($request, __('admin/global.words.basic_information')),

			//Insurances
			InsuranceMenu::getMenu($request),

			//Specialities
			SpecialityMenu::getMenu($request),

			//Separator
			SeparatorMenu::getMenu($request, __('admin/global.words.modules')),

			//Blogs
			BlogMenu::getMenu($request),

			//Services
			ServiceMenu::getMenu($request),

			//Clinics
			ClinicMenu::getMenu($request),

			//Doctors
			DoctorMenu::getMenu($request),

			//Galleries
			GalleryMenu::getMenu($request),

			//Testimonials
			TestimonialMenu::getMenu($request),

			//Separator
			SeparatorMenu::getMenu($request, __('admin/page.plural')),

			//Home
			HomeMenu::getMenu($request),

			//Communications
			CommunicationMenu::getMenu($request),

		])->merge(CommonMenus::getMenu($request));

		$view->with('menus', $menus);
	}
}