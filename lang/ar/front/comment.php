<?php

return [
	'singular' => 'نظر',
	'plural' => 'نظرات',

	//Fields
	'fields' => [
		'full_name' => 'نام و نام خانوادگی',
		'email' => 'پست الکترونیک',
		'mobile' => 'موبایل',
		'body' => 'نظر شما',
	],

	//Placeholders
	'placeholders' => [
		'full_name' => 'مثلا: رضا کمالزاده',
		'email' => 'example@domain.com',
		'mobile' => 'موبایل',
		'body' => 'حداقل 10 کارکتر باید تایپ کنید ...',
	],

	//Errors
	'errors' => [
		'full_name' => [
			'required' => 'لطفا نام و نام خانوادگی را وارد کنید',
		],
		'email' => [
			'required' => 'لطفا پست الکترونیک را وارد کنید',
		],
		'mobile' => [
			'required' => 'لطفا موبایل را وارد کنید',
		],
		'body' => [
			'required' => 'لطفا متن نظر را وارد کنید',
			'min' => 'متن نظر نمی تواند کمتر از 10 کاراکتر باشد',
		],
		'model_type' => [
			'required' => 'خطایی رخ داده است، لطفا دوباره تلاش کنید',
		],
	],

	//Words
	'words' => [
		'user' => 'نظرات کاربران',
		'save' => 'ثبت نظر',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [
		'privacy' => 'نشانی ایمیل شما منتشر نخواهد شد.',
	],
];