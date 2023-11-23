<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		if ($this->app->environment('local')) {
			$this->app->register(TelescopeServiceProvider::class);
			$this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
		}
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(Request $request): void
	{
		Paginator::defaultView('pagination::default');

		if ($request->segment(1) === 'admin') {
			$this->app->register(AdminDashboardMenuProvider::class);

			//Datatables html
			Builder::useVite();
		} else {
			$this->app->register(FrontNavbarMenuProvider::class);
			$this->app->register(FrontCommonProvider::class);
		}
	}
}
