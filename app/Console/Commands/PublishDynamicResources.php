<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class PublishDynamicResources extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'resource:dynamic';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish dynamic resources in static files';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		Artisan::call('cache:clear');
		Artisan::call('view:clear');

		$client = new Client([
			'verify' => false,
		]);

		$locales = config('app.available_locales');
		foreach ($locales as $locale) {
			if (File::exists(public_path("assets/shared/js/router-$locale.js"))) {
				File::delete(public_path("assets/shared/js/router-$locale.js"));
			}
			$routeResource = Utils::tryFopen(public_path("assets/shared/js/router-$locale.js"), 'w');
			$client->request('GET', route('assets.router', ['lang' => $locale]), ['sink' => $routeResource]);


			if (File::exists(public_path("assets/shared/js/translations-$locale.js"))) {
				File::delete(public_path("assets/shared/js/translations-$locale.js"));
			}
			$translationResource = Utils::tryFopen(public_path("assets/shared/js/translations-$locale.js"), 'w');
			$client->request('GET', route('assets.translations', ['lang' => $locale]), ['sink' => $translationResource]);
		}
	}
}
