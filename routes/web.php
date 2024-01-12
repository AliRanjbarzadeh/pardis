<?php

use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\Front\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('global.configs')->group(function () {
	Route::get('bug', [BugController::class, 'index']);

	$locale = \App\Helpers\General::getLocaleFromDomain(request()->root());
	if ($locale == 'fa') {
		Route::domain(config('domain.base_domain'))->group(base_path('routes/web/fa.php'));
		Route::domain(config('domain.base_domain'))->group(base_path('routes/web/admin.php'));
	} else {
		Route::domain("$locale." . config('domain.base_domain'))->group(base_path("routes/web/$locale.php"));
		Route::domain("$locale." . config('domain.base_domain'))->group(base_path('routes/web/admin.php'));
	}

	//Comment
	Route::prefix('comments')->name('comments.')->group(function () {
		Route::post('{modelId}/store', [CommentController::class, 'store'])->name('store');
	});

	//Resource routes
	Route::prefix('js')->name('assets.')->group(function () {
		Route::get('{lang}/translations.js', [RouteController::class, 'translations'])->name('translations');
		Route::get('{lang}/router.js', [RouteController::class, 'router'])->name('router');
	});
});

