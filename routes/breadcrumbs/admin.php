<?php // routes/breadcrumbs/admin.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Database\Eloquent\Model;

Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
	$trail->push(__('admin/dashboard.singular'), route('admin.index'));
});

Breadcrumbs::macro('admin', function (string $name, string $title, ?string $parent = null, ?array $children = null) {
	//index
	Breadcrumbs::for("$name.index", function (BreadcrumbTrail $trail) use ($name, $title, $parent) {
		if (!is_null($parent)) {
			$trail->parent($parent);
		} else {
			$trail->parent('admin.index');
		}
		$trail->push($title, route("$name.index"));
	});

	//create
	Breadcrumbs::for("$name.create", function (BreadcrumbTrail $trail) use ($name) {
		$trail->parent("$name.index");
		$trail->push(__('admin/global.fields.create'), route("$name.create"));
	});

	//edit
	Breadcrumbs::for("$name.edit", function (BreadcrumbTrail $trail, Model $model) use ($name) {
		$trail->parent("$name.index");
		$trail->push(__('admin/global.fields.edit'), route("$name.edit", $model));
	});

	if (!is_null($children)) {
		foreach ($children as $child) {
			Breadcrumbs::for("$name.{$child['name']}.index", function (BreadcrumbTrail $trail) use ($name, $child) {
				$trail->parent("$name.index");
				$trail->push($child['title']);
			});
		}
	}
});

Breadcrumbs::macro('adminChildren', function (string $parentTrail, string $name, string $title, string $parentTitleKey = 'title') {
	//index
	Breadcrumbs::for("$name.index", function (BreadcrumbTrail $trail, Model $parent) use ($name, $title, $parentTrail, $parentTitleKey) {
		$trail->parent($parentTrail);
		$trail->push($parent->{$parentTitleKey}, route("$name.index", $parent));
	});

	//create
	Breadcrumbs::for("$name.create", function (BreadcrumbTrail $trail, Model $parent) use ($name) {
		$trail->parent("$name.index", $parent);
		$trail->push(__('admin/global.fields.create'), route("$name.create", [$parent]));
	});

	//edit
	Breadcrumbs::for("$name.edit", function (BreadcrumbTrail $trail, Model $parent, Model $model) use ($name) {
		$trail->parent("$name.index", $parent);
		$trail->push(__('admin/global.fields.edit'), route("$name.edit", [$parent, $model]));
	});
});

Breadcrumbs::macro('adminCategories', function (string $type, string $title, bool $hasChild = false) {
	Breadcrumbs::admin(name: 'admin.categories.' . $type, title: $title, parent: 'admin.' . \Illuminate\Support\Str::plural($type) . '.index');
	if ($hasChild) {
		Breadcrumbs::adminChildren(parentTrail: 'admin.categories.' . $type . '.index', name: 'admin.categories.' . $type . '.children', title: __('admin/category.words.children'), parentTitleKey: 'name');
	}
});

Breadcrumbs::macro('adminComments', function (string $type, string $title, string $modelTitleKey = 'title') {
	//Model
	Breadcrumbs::for("admin.$type.comments.index", function (BreadcrumbTrail $trail, int $parent) use ($title, $type, $modelTitleKey) {
		$trail->parent("admin.$type.index");
		$model = 'App\\Models\\' . \Illuminate\Support\Str::studly(\Illuminate\Support\Str::singular($type));
		if (class_exists($model)) {
			$parentItem = $model::find($parent);
			if (!is_null($parentItem)) {
				$trail->push($parentItem->{$modelTitleKey});
			}
		}
		$trail->push($title, route("admin.$type.comments.index", $parent));
	});

	//All
	Breadcrumbs::for("admin.$type.comments.all.index", function (BreadcrumbTrail $trail) use ($title, $type) {
		$trail->parent("admin.$type.index");
		$trail->push($title);
	});
});

Breadcrumbs::macro('adminPage', function (string $page, string $title, array $options) {
	Breadcrumbs::for("admin.$page", function (BreadcrumbTrail $trail) use ($title) {
		$trail->parent('admin.index');
		$trail->push($title);
	});

	if (isset($options['slider'])) {
		Breadcrumbs::admin(name: "admin.$page.sliders", title: __('admin/slider.plural'), parent: "admin.$page");
	}
	if (isset($options['setting'])) {
		Breadcrumbs::for("admin.$page.settings.index", function (BreadcrumbTrail $trail) use ($page) {
			$trail->parent("admin.$page");
			$trail->push(__('admin/setting.plural'));
		});
	}
});

//Insurances
Breadcrumbs::admin('admin.insurances', __('admin/insurance.plural'));
Breadcrumbs::adminCategories('insurance', __('admin/category.plural'), true);

//Services
Breadcrumbs::admin(name: 'admin.services', title: __('admin/service.plural'), children: [
	[
		'name' => 'settings',
		'title' => __('admin/setting.plural'),
	],
]);
Breadcrumbs::adminComments('services', __('admin/comment.plural'));

//Clinics
Breadcrumbs::admin(name: 'admin.clinics', title: __('admin/clinic.plural'), children: [
	[
		'name' => 'settings',
		'title' => __('admin/setting.plural'),
	],
]);

//Doctors
Breadcrumbs::admin(name: 'admin.doctors', title: __('admin/doctor.plural'), children: [
	[
		'name' => 'settings',
		'title' => __('admin/setting.plural'),
	],
]);
Breadcrumbs::adminComments('doctors', __('admin/comment.plural'), 'full_name');

//Specialities
Breadcrumbs::admin('admin.specialities', __('admin/speciality.plural'));

//Blogs
Breadcrumbs::admin(name: 'admin.blogs', title: __('admin/blog.plural'), children: [
	[
		'name' => 'settings',
		'title' => __('admin/setting.plural'),
	],
]);
Breadcrumbs::adminCategories('blog', __('admin/category.plural'));
Breadcrumbs::adminComments('blogs', __('admin/comment.plural'));

//Galleries
Breadcrumbs::admin('admin.galleries', __('admin/gallery.plural'));
Breadcrumbs::adminCategories('gallery', __('admin/category.plural'));

//Testimonials
Breadcrumbs::admin('admin.testimonials', __('admin/testimonial.plural'));

//Popups
Breadcrumbs::admin('admin.popups', __('admin/popup.plural'));

//Home
Breadcrumbs::adminPage('home', __('admin/page.words.home'), [
	'slider' => true,
	'setting' => true,
]);

//Communications
Breadcrumbs::admin(name: 'admin.communications', title: __('admin/communication.plural'));

//About
Breadcrumbs::admin(name: 'admin.about', title: __('admin/about.singular'));

//Contact
Breadcrumbs::admin(name: 'admin.contacts', title: __('admin/contact.plural'), children: [
	[
		'name' => 'settings',
		'title' => __('admin/setting.plural'),
	],
]);
