<?php

namespace App\Http\Middleware;

use App\Helpers\General;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		//get locale from domain root
		$locale = General::getLocaleFromDomain($request->root());

		if ($locale != 'fa') {
			//set database connection
			config(['database.default' => "mysql_$locale"]);
		}

		//set session path
		config(['session.files' => base_path("storage/framework/sessions/$locale")]);

		//change locale of app
		App::setLocale($locale);


		return $next($request);
	}
}
