<?php

namespace App\Providers;

use App\Helpers\MediumHelper;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
	    $this->app->bind('media', function () {
		    return new MediumHelper;
	    });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
