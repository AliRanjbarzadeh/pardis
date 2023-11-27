<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryChildController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

	//Authenticate
	Route::prefix('auth')->name('auth.')->middleware('guest.admin:admin')->group(function () {
		Route::get('/', [AuthController::class, 'index'])->name('index');
		Route::post('/', [AuthController::class, 'verify'])->name('verify');
	});

	//Dashboard
	Route::middleware('auth.admin:admin')->group(function () {
		//Categories
		Route::macro('categories', function (string $type, bool $hasChild) {
			Route::prefix('categories')->name('categories.')->group(function () use ($type, $hasChild) {

				if ($hasChild) {
					Route::prefix($type . '/{parent}')->name("$type.")->group(function () {
						Route::prefix('children')->name('children.')->group(function () {
							Route::post('datatable', [CategoryChildController::class, 'datatable'])->name('datatable');
						});
						Route::resource('children', CategoryChildController::class, ['trailingSlashExcept' => 'destroy'])
							->parameters([
								'children' => 'category',
							])
							->except('show');
					});
				}

				Route::post($type . '/datatable', [CategoryController::class, 'datatable'])->name("$type.datatable");
				Route::resource($type, CategoryController::class, ['trailingSlashExcept' => 'destroy'])
					->parameters([
						"$type" => 'category',
					])
					->except('show');
			});
		});

		//Comments
		Route::prefix('comments')->name('comments.')->group(function () {
			Route::patch('approve/{comment}', [CommentController::class, 'approve'])->name('approve');
			Route::patch('reject/{comment}', [CommentController::class, 'reject'])->name('reject');
			Route::delete('destroy/{comment}', [CommentController::class, 'destroy'])->name('destroy');
		});
		Route::macro('comments', function (string $type) {
			$typePlural = \Illuminate\Support\Str::plural($type);
			Route::prefix($typePlural)->name("$typePlural.comments.")->group(function () use ($typePlural, $type) {
				Route::prefix('comments')->name('all.')->group(function () {
					Route::get('/', [CommentController::class, 'all'])->name('index');
					Route::post('datatable', [CommentController::class, 'allDatatable'])->name('datatable');
				});
				Route::get("{{$type}}/comments/", [CommentController::class, 'index'])->name('index');
				Route::post("{{$type}}/comments/datatable", [CommentController::class, 'datatable'])->name('datatable');
			});
		});

		//Settings
		Route::macro('settings', function (string $controllerClass) {
			Route::prefix('settings')->name('settings.')->group(function () use ($controllerClass) {
				Route::get('/', [$controllerClass, 'settings'])->name('index');
				Route::post('', [$controllerClass, 'settingsStore'])->name('store');
			});
		});

		//Sliders
		Route::macro('sliders', function (string $page) {
			Route::prefix("$page/sliders")->name("$page.sliders.")->group(function () {
				Route::post('datatable', [SliderController::class, 'datatable'])->name('datatable');
			});
			Route::resource("$page.sliders/", SliderController::class, ['trailingSlashExcept' => 'destroy'])
				->parameters([
					"$page" => 'slider',
				])
				->except('show');
		});

		//Dashboard
		Route::get('/', [DashboardController::class, 'index'])->name('index');

		//Insurances
		Route::prefix('insurances')->name('insurances.')->group(function () {
			Route::post('datatable', [InsuranceController::class, 'datatable'])->name('datatable');
		});
		Route::categories('insurance', true);
		Route::resource('insurances/', InsuranceController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Specialities
		Route::prefix('specialities')->name('specialities.')->group(function () {
			Route::post('datatable', [SpecialityController::class, 'datatable'])->name('datatable');
		});
		Route::resource('specialities/', SpecialityController::class, ['trailingSlashExcept' => 'destroy']);

		//Blogs
		Route::prefix('blogs')->name('blogs.')->group(function () {
			Route::post('datatable', [BlogController::class, 'datatable'])->name('datatable');

			//Settings
			Route::settings(BlogController::class);

			//Search
			Route::post('search', [BlogController::class, 'search'])->name('search');
		});
		Route::categories('blog', false);
		Route::comments('blog');
		Route::resource('blogs/', BlogController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Services
		Route::prefix('services')->name('services.')->group(function () {
			Route::post('datatable', [ServiceController::class, 'datatable'])->name('datatable');

			//Settings
			Route::settings(ServiceController::class);
		});
		Route::comments('service');
		Route::resource('services/', ServiceController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Clinics
		Route::prefix('clinics')->name('clinics.')->group(function () {
			Route::post('datatable', [ClinicController::class, 'datatable'])->name('datatable');

			//Settings
			Route::settings(ClinicController::class);
		});
		Route::resource('clinics/', ClinicController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Doctors
		Route::prefix('doctors')->name('doctors.')->group(function () {
			Route::post('datatable', [DoctorController::class, 'datatable'])->name('datatable');

			//Settings
			Route::settings(DoctorController::class);
		});
		Route::comments('doctor');
		Route::resource('doctors/', DoctorController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Gallery
		Route::prefix('galleries')->name('galleries.')->group(function () {
			Route::post('datatable', [GalleryController::class, 'datatable'])->name('datatable');
		});
		Route::categories('gallery', false);
		Route::resource('galleries/', GalleryController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Testimonials
		Route::prefix('testimonials')->name('testimonials.')->group(function () {
			Route::post('datatable', [TestimonialController::class, 'datatable'])->name('datatable');
		});
		Route::resource('testimonials/', TestimonialController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Home
		Route::prefix('home')->name('home.')->group(function () {
			Route::settings(HomeController::class);
		});
		Route::sliders('home');

		//Communications
		Route::prefix('communications')->name('communications.')->group(function () {
			Route::post('datatable', [CommunicationController::class, 'datatable'])->name('datatable');
		});
		Route::resource('communications/', CommunicationController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//About
		Route::prefix('about')->name('about.')->group(function () {
			Route::get('/', [AboutController::class, 'index'])->name('index');
			Route::post('', [AboutController::class, 'store'])->name('store');
		});

		//Contact
		Route::prefix('contacts')->name('contacts.')->group(function () {
			Route::post('datatable', [ContactController::class, 'datatable'])->name('datatable');

			Route::settings(ContactController::class);
		});
		Route::resource('contacts/', ContactController::class, [
			'trailingSlashExcept' => 'destroy',
			'parameters' => [
				'contact' => 'contactForm',
			],
		])->except('create', 'edit', 'store');

		//Footer
		Route::prefix('footer')->name('footer.')->group(function () {
			Route::settings(FooterController::class);
		});

		//Priority
		Route::post('priority', [PriorityController::class, 'index'])->name('priority');

		//Public upload
		Route::prefix('media')->name('media.')->group(function () {
			Route::post('ckeditor', [MediaController::class, 'ckEditor'])->name('ckeditor');
			Route::post('dropzone', [MediaController::class, 'dropzone'])->name('dropzone');
			Route::delete('{id}/destroy', [MediaController::class, 'destroy'])->name('destroy');
		});
	});
});
