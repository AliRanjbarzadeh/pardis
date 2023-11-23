<?php

namespace App\Providers;

use App\Http\ViewComposers\Front\NavbarMenuComposer;
use Illuminate\Support\ServiceProvider;

class FrontNavbarMenuProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		$this->navbarMenu();
	}

	private function navbarMenu()
	{
		view()->composer(['front.layouts.header.navbar', 'front.layouts.header.mobile-nav'], NavbarMenuComposer::class);
	}
}
