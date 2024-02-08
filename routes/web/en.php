<?php

use App\Http\Controllers\Front\AmpController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ClinicController;
use App\Http\Controllers\Front\CommonController;
use App\Http\Controllers\Front\DoctorController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InsuranceController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\SiteMapController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
//	\Illuminate\Support\Facades\Artisan::call('view:clear');
//	\Illuminate\Support\Facades\Artisan::call('config:clear');
});

//admin routes
//Route::scopeBindings()->group(base_path('routes/web/admin.php'));


//web routes
Route::get('', [HomeController::class, 'index'])->name('index');

//clinics
Route::prefix('clinic')->name('clinics.')->group(function () {
	Route::get('', [ClinicController::class, 'index'])->name('index');
	Route::get('{seoLink}', [ClinicController::class, 'show'])->name('show');
});

//doctors
Route::prefix('specialists')->name('doctors.')->group(function () {
	Route::get('', [DoctorController::class, 'index'])->name('index');
	Route::get('detail/{doctor}/{seoLink}', [DoctorController::class, 'show'])->name('show');
	Route::get('c/{speciality}/{seoLink}', [DoctorController::class, 'category'])->name('category');
});

//services
Route::prefix('services')->name('services.')->group(function () {
	Route::get('', [ServiceController::class, 'index'])->name('index');
	Route::get('{seoLink}', [ServiceController::class, 'show'])->name('show');
});

//blogs
Route::get('cancer', [BlogController::class, 'cancer']);
Route::prefix('blog')->name('blogs.')->group(function () {
	Route::get('', [BlogController::class, 'index'])->name('index');
	Route::get('{seoLink}', [BlogController::class, 'show'])->name('show');
	Route::get('category/{seoLink}', [BlogController::class, 'category'])->name('category');
});

//insurances
Route::resource('insurances', InsuranceController::class)->only('index', 'show');

//about
Route::get('about-us', [CommonController::class, 'about'])->name('about');

//contact
Route::prefix('contact-us')->name('contact.')->group(function () {
	Route::get('', [CommonController::class, 'contact'])->name('index');
	Route::post('', [CommonController::class, 'contact_store'])->name('store');
});

//sitemap
Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap.xml');

//amp
Route::prefix('amp')->name('amp.')->group(function () {
	Route::get('{seoLink}', [AmpController::class, 'index'])->name('index');
	Route::post('{blog}/rate', [AmpController::class, 'rate'])->name('rate');
	Route::post('{blog}/comment', [AmpController::class, 'comment'])->name('comment');
});
