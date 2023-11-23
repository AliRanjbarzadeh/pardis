<?php

namespace App\Providers;

use App\Enums\PageTypeEnum;
use App\Services\PageService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontCommonProvider extends ServiceProvider
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
		$this->contactPageInfo();
	}


	private function contactPageInfo()
	{
		$contactPage = $this->app->make(PageService::class)->find(PageTypeEnum::Contact, ['metas', 'socialNetworks']);
		View::share('contactInfo', $contactPage);
	}
}
