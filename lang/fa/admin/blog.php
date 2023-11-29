<?php

return [
	'singular' => 'مقاله',
	'plural' => 'مقالات',

	//Fields
	'fields' => [
		'title' => 'عنوان مقاله',
		'description' => 'توضیحات مقاله',
		'home' => [
			'title' => 'عنوان مقالات',
		],
		'dataTable' => [
			'title' => 'عنوان مقاله',
			'model_key' => 'commentable.title',
		],
	],

	//Placeholders
	'placeholders' => [
		'title' => 'مثلا: عنوان مقاله یک',
		'description' => 'مثلا: توضیحات مقاله یک',
		'home' => [
			'title' => 'مثلا: آخرین مطالب',
		],
	],

	//Errors
	'errors' => [
		'category' => [
			'required' => 'لطفا دسته بندی را انتخاب کنید',
		],
		'clinic' => [
			'required' => 'لطفا کلینیک را انتخاب کنید',
		],
		'doctor' => [
			'required' => 'لطفا پزشک را انتخاب کنید',
		],
		'title' => [
			'required' => 'لطفا عنوان مقاله را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا توضیحات مقاله را وارد کنید',
		],
	],

	//Words
	'words' => [
		'top' => 'مقالات برتر',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [],
];