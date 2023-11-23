<?php

return [
	'singular' => 'بیمه',
	'plural' => 'بیمه ها',

	//Fields
	'fields' => [
		'name' => 'نام بیمه',
		'description' => 'توضیحات بیمه',
		'home' => [
			'title' => 'عنوان بیمه ها',
		],
	],

	//Placeholders
	'placeholders' => [
		'name' => 'مثلا: بیمه تست',
		'description' => 'مثلا: توضیحات بیمه تست',
		'home' => [
			'title' => 'مثلا: بیمه های طرف قرارداد',
		],
	],

	//Errors
	'errors' => [
		'name' => [
			'required' => 'لطفا نام بیمه را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا توضیحات بیمه را وارد کنید',
		],
	],

	//Words
	'words' => [],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [
		'logs' => [
			'created' => 'تعریف بیمه جدید',
			'updated' => 'ویرایش بیمه',
			'deleted' => 'حذف بیمه',
		],
	],
];