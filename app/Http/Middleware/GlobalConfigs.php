<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use App\Services\SettingService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class GlobalConfigs
{
	public function __construct(
		protected SettingService $settingService,
	)
	{
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		$resourceVersion = config('global.version.resource');
		if (app()->isLocal()) {
			$resourceVersion = time();
		}

		$this->settingService->all()->map(function (Setting $setting) {
			config()->set($setting->setting_key, $setting->setting_value);
		});

		View::share('resourceVersion', $resourceVersion);

		return $next($request);
	}
}
