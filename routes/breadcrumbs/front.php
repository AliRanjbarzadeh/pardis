<?php // routes/breadcrumbs/front.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Database\Eloquent\Model;

Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
	$trail->push(__('front/home.singular'), route('index'));
});

Breadcrumbs::macro('web', function (string $name, string $title, bool $isHasModel = false, string $modelTitleKey = 'title', ?array $children = null) {
	//index
	Breadcrumbs::for("$name.index", function (BreadcrumbTrail $trail) use ($name, $title) {
		$trail->parent('index');
		$trail->push($title, route("$name.index"));
	});

	//show
	if ($isHasModel) {
		Breadcrumbs::for("$name.show", function (BreadcrumbTrail $trail, Model $model, ?string $seoLink) use ($name, $modelTitleKey) {
			$trail->parent("$name.index");
			$trail->push($model->{$modelTitleKey});
		});
	} else {
		Breadcrumbs::for("$name.show", function (BreadcrumbTrail $trail, string $seoLink) use ($name, $modelTitleKey) {
			$trail->parent("$name.index");

			$model = request()->route()->getController()->getModel();
			if (!is_null($model)) {
				$trail->push($model->{$modelTitleKey});
			}
		});
	}
});

//Clinics
Breadcrumbs::web(name: 'clinics', title: __('front/clinic.plural'));

//Doctors
Breadcrumbs::web(name: 'doctors', title: __('front/doctor.plural'), isHasModel: true, modelTitleKey: 'full_name');

//Services
Breadcrumbs::web(name: 'services', title: __('front/service.plural'));

//Blogs
Breadcrumbs::web(name: 'blogs', title: __('front/blog.plural'));

//Insurances
Breadcrumbs::for('insurances.index', function (BreadcrumbTrail $trail) {
	$trail->parent('index');
	$trail->push(__('front/insurance.plural'), route('insurances.index'));
});

//About
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
	$trail->parent('index');
	$trail->push(__('front/global.words.about_us.menu.title'), route('about'));
});

//Contact
Breadcrumbs::for('contact.index', function (BreadcrumbTrail $trail) {
	$trail->parent('index');
	$trail->push(__('front/global.words.contact_us.menu.title'), route('contact.index'));
});