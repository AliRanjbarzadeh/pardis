<?php

namespace App\Providers;

use App\Http\ViewComposers\Admin\SideMenuComposer;
use Illuminate\Support\ServiceProvider;

class AdminDashboardMenuProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		$this->sideMenu();
	}

	private function sideMenu()
	{
		view()->composer('admin.layouts.aside-menu', SideMenuComposer::class);
	}
}
