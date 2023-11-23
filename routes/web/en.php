<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

//admin routes
Route::scopeBindings()->group(base_path('routes/web/admin.php'));
