<?php

return [
	'singular' => 'پاپ آپ',
	'plural' => 'پاپ آپ ها',

	//Fields
	'fields' => [
		'status' => 'وضعیت',
		'type' => 'نوع',
		'title' => 'عنوان',
		'description' => 'توضیحات',
		'url' => 'آدرس لینک',
	],

	//Placeholders
	'placeholders' => [
		'title' => 'مثلا: پاپ آپ',
		'description' => 'مثلا: توضیحات پاپ آپ',
		'url' => 'مثلا: https://pardiscancer.com',
	],

	//Errors
	'errors' => [
		'type' => [
			'required' => 'لطفا نوع را انتخاب کنید',
		],
		'title' => [
			'required' => 'لطفا عنوان را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا توضیحات را وارد کنید',
		],
		'url' => [
			'required' => 'لطفا آدرس لینک را وارد کنید',
			'url' => 'آدرس لینک وارد شده معتبر نمی باشد',
		],
	],

	//Words
	'words' => [
		'types' => [
			'text' => 'متن',
			'image' => 'عکس',
		],
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [],
];