<?php

return [
	'singular' => 'پزشک',
	'plural' => 'پزشکان',

	//Fields
	'fields' => [
		'full_name' => 'نام و نام خانوادگی',
		'first_name' => 'نام',
		'last_name' => 'نام خانوادگی',
		'medical_number' => 'شماره نظام پزشکی',
		'description' => 'درباره دکتر (مختصر)',
		'full_description' => 'توضیحات کامل',
		'work_hours' => 'ساعت کاری',
		'reservation_link' => 'لینک نوبت دهی',
		'home' => [
			'title' => 'عنوان پزشکان برتر',
		],
		'dataTable' => [
			'title' => 'نام دکتر',
			'model_key' => 'commentable.full_name',
		],
	],

	//Placeholders
	'placeholders' => [
		'first_name' => 'مثلا: نیما',
		'last_name' => 'مثلا: حسینی',
		'medical_number' => 'مثلا: 123456',
		'description' => 'مثلا: پزشک متخصص اطفال با سابقه درخشان',
		'full_description' => 'مثلا: توضیحات کامل پزشک',
		'reservation_link' => 'مثلا: https://pardiscancer.com',
		'home' => [
			'title' => 'مثلا: پزشکان برتر',
		],
	],

	//Errors
	'errors' => [
		'clinics' => [
			'required' => 'لطفا یک کلینیک را انتخاب کنید',
		],
		'speciality_id' => [
			'required' => 'لطفا تخصص را انتخاب کنید',
		],
		'first_name' => [
			'required' => 'لطفا نام را وارد کنید',
		],
		'last_name' => [
			'required' => 'لطفا نام خانوادگی را وارد کنید',
		],
		'medical_number' => [
			'required' => 'لطفا شماره نظام پزشکی را وارد کنید',
		],
		'description' => [
			'required' => 'لطفا درباره دکتر را وارد کنید',
		],
		'full_description' => [
			'required' => 'لطفا توضیحات را وارد کنید',
		],
		'reservation_link' => [
			'required' => 'لطفا لینک نوبت دهی را وارد کنید',
			'url' => 'لینک نوبت دهی وارد شده معتبر نمی باشد',
		],
	],

	//Words
	'words' => [],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [],
];