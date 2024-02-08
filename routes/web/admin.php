<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
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
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\RoleController;
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
		//Logout
		Route::get('logout', [AuthController::class, 'logout'])->name('logout');

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

		//Datatables
		Route::macro('datatable', function (string $routeName, string $routeController, ?string $prefix = null) {
			Route::prefix($prefix ?? $routeName)->name("$routeName.")->group(function () use ($routeController) {
				Route::post('datatable', [$routeController, 'datatable'])->name('datatable');
			});
		});

		//Dashboard
		Route::get('/', [DashboardController::class, 'index'])->name('index');

		//Roles
		Route::datatable('roles', RoleController::class);
		Route::resource('roles/', RoleController::class, ['trailingSlashExcept' => 'destroy']);

		//Admins
		Route::datatable('admins', AdminController::class);
		Route::resource('admins/', AdminController::class, ['trailingSlashExcept' => 'destroy']);

		//Insurances
		Route::datatable('insurances', InsuranceController::class);
		Route::categories('insurance', true);
		Route::resource('insurances/', InsuranceController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Specialities
		Route::datatable('specialities', SpecialityController::class);
		Route::resource('specialities/', SpecialityController::class, ['trailingSlashExcept' => 'destroy']);

		//Blogs
		Route::prefix('blogs')->name('blogs.')->group(function () {
			//Settings
			Route::settings(BlogController::class);

			//Search
			Route::post('search', [BlogController::class, 'search'])->name('search');
		});
		Route::datatable('blogs', BlogController::class);
		Route::categories('blog', false);
		Route::comments('blog');
		Route::resource('blogs/', BlogController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Services
		Route::prefix('services')->name('services.')->group(function () {
			//Settings
			Route::settings(ServiceController::class);
		});
		Route::datatable('services', ServiceController::class);
		Route::comments('service');
		Route::resource('services/', ServiceController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Clinics
		Route::prefix('clinics')->name('clinics.')->group(function () {
			//Settings
			Route::settings(ClinicController::class);
		});
		Route::datatable('clinics', ClinicController::class);
		Route::resource('clinics/', ClinicController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Doctors
		Route::prefix('doctors')->name('doctors.')->group(function () {
			//Settings
			Route::settings(DoctorController::class);
		});
		Route::datatable('doctors', DoctorController::class);
		Route::comments('doctor');
		Route::resource('doctors/', DoctorController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Gallery
		Route::datatable('galleries', GalleryController::class);
		Route::categories('gallery', false);
		Route::resource('galleries/', GalleryController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Testimonials
		Route::datatable('testimonials', TestimonialController::class);
		Route::resource('testimonials/', TestimonialController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Popups
		Route::prefix('popups')->name('popups.')->group(function () {
			Route::patch('{popup}/changeStatus', [PopupController::class, 'changeStatus'])->name('changeStatus');
		});
		Route::datatable('popups', PopupController::class);
		Route::resource('popups/', PopupController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//Home
		Route::prefix('home')->name('home.')->group(function () {
			Route::settings(HomeController::class);
		});
		Route::sliders('home');

		//Communications
		Route::datatable('communications', CommunicationController::class);
		Route::resource('communications/', CommunicationController::class, ['trailingSlashExcept' => 'destroy'])->except('show');

		//About
		Route::prefix('about')->name('about.')->group(function () {
			Route::get('/', [AboutController::class, 'index'])->name('index');
			Route::post('', [AboutController::class, 'store'])->name('store');
		});

		//Contact
		Route::prefix('contacts')->name('contacts.')->group(function () {
			Route::settings(ContactController::class);
		});
		Route::datatable('contacts', ContactController::class);
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
