<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DatatablesSearchBoxProvider extends ServiceProvider
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
		Blade::directive('datatablesFilters', function () {
			return '<?php echo isset($filters) ? $filters : ""; ?>';
		});
	}
}
