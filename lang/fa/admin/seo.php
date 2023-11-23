<?php

return [
	'singular' => 'سئو',

	//Fields
	'fields' => [
		'title' => 'عنوان سئو',
		'description' => 'توضیحات سئو',
		'keywords' => 'کلمات کلیدی',
		'link' => 'لینک سئو',
	],

	//Placeholders
	'placeholders' => [
		'title' => 'مثلا: عنوان سئو',
		'description' => 'مثلا: توضیحات سئو',
		'keywords' => 'مثلا: کلمات کلیدی',
		'link' => 'مثلا: لینک سئو',
	],

	//Errors
	'errors' => [
		'title' => [
			'required' => 'لطفا عنوان سئو را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا توضیحات سئو را وارد کنید',
		],
		'keywords' => [
			'required' => 'لطفا کلمات کلیدی را وارد کنید',
			'array' => 'کلمات کلیدی باید آرایه باشد',
		],
		'link' => [
			'required' => 'لطفا لینک سئو را وارد کنید',
			'unique' => 'لینک سئو وارد شده از قبل وجود دارد',
		],
	],

	//Words
	'words' => [
		'information' => 'اطلاعات سئو',
	],

	//Actions

	//Sentences
	'sentences' => [
		'logs' => [
			'created' => 'تعریف سئو',
			'updated' => 'ویرایش سئو',
			'deleted' => 'حذف سئو',
		],
	],
];