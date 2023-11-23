<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthenticateAdmin extends Middleware
{
	protected function redirectTo(Request $request)
	{
		if (!$request->expectsJson()) {
			return route('admin.auth.index');
		}

		return response()->json(['message' => __('auth.failed')], 401);
	}
}
