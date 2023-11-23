<?php

return [
	'singular' => 'خدمت',
	'plural' => 'خدمات',

	//Fields
	'fields' => [
		'title' => 'عنوان خدمت',
		'description' => 'توضیحات',
		'full_description' => 'توضیحات کامل',
		'home' => [
			'title' => 'عنوان خدمات',
			'description' => 'توضیحات کوتاه خدمات',
		],
	],

	//Placeholders
	'placeholders' => [
		'title' => 'مثلا: عنوان خدمت',
		'description' => 'مثلا: توضیحات خدمت',
		'full_description' => 'مثلا: توضیحات کامل خدمت',
		'home' => [
			'title' => 'مثلا: خدمات ما',
			'description' => 'مثلا: توضیحات خدمات ما',
		],
	],

	//Errors
	'errors' => [
		'title' => [
			'required' => 'لطفا عنوان خدمت را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا توضیحات خدمت را وارد کنید',
		],
		'full_description' => [
			'required' => 'لطفا توضیحات کامل خدمت را وارد کنید',
		],
	],

	//Words

	//Actions

	//Sentences
	'sentences' => [
		'comments' => [
			'single' => 'نظرات خدمت با عنوان <span class="text-dark fw-bolder ms-1">:title</span>',
			'all' => 'نظرات خدمات',
		],
		'logs' => [
			'created' => 'تعریف خدمت جدید',
			'updated' => 'ویرایش خدمت',
			'deleted' => 'حذف خدمت',
		],
	],
];