<?php

return [
	'singular' => 'رأي',
	'plural' => 'تعليقات',

	//Fields
	'fields' => [
		'full_name' => 'الاسم الأول والاسم الأخير',
		'email' => 'بريد إلكتروني',
		'mobile' => 'متحرك',
		'body' => 'تعليق',
	],

	//Placeholders
	'placeholders' => [
		'full_name' => 'على سبيل المثال: رضا کمالزاده',
		'email' => 'example@domain.com',
		'mobile' => 'متحرك',
		'body' => 'يجب عليك كتابة 10 أحرف على الأقل ...',
	],

	//Errors
	'errors' => [
		'full_name' => [
			'required' => 'الرجاء إدخال الاسم الأول والأخير',
		],
		'email' => [
			'required' => 'الرجاء إدخال عنوان البريد الإلكتروني الخاص بك',
		],
		'mobile' => [
			'required' => 'الرجاء إدخال الهاتف المحمول',
		],
		'body' => [
			'required' => 'الرجاء إدخال نص التعليق',
			'min' => 'لا يمكن أن يقل نص التعليق عن 10 أحرف',
		],
		'model_type' => [
			'required' => 'خطایی رخ داده است، لطفا دوباره تلاش کنید',
		],
	],

	//Words
	'words' => [
		'user' => 'تعليقات المستخدم',
		'save' => 'تسجيل تعليق',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [
		'privacy' => 'لن يتم نشر عنوان بريدك الإلكتروني.',
	],
];