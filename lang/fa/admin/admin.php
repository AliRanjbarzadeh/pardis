<?php

return [
	'singular' => 'مدیر پنل',
	'plural' => 'مدیران پنل',

	//Fields
	'fields' => [
		'role_id' => 'نقش',
		'name' => 'نام و نام خانوادگی',
		'username' => 'نام کاربری',
		'password' => 'کلمه عبور',
		're_password' => 'تکرار کلمه عبور',
	],

	//Placeholders
	'placeholders' => [
		'name' => 'مثلا: احسان علیخانی',
		'username' => 'مثلا: ehsan',
		'password' => 'مثلا: 123',
		're_password' => 'مثلا: 123',
	],

	//Errors
	'errors' => [
		'role_id' => [
			'required' => 'لطفا یک نقش انتخاب کنید',
		],
		'name' => [
			'required' => 'لطفا نام را وارد کنید',
		],
		'username' => [
			'required' => 'لطفا نام کاربری را وارد کنید',
			'unique' => 'نام کاربری وارد شده از قبل وجود دارد',
		],
		'password' => [
			'required' => 'لطفا کلمه عبور را وارد کنید',
			'min' => 'کلمه عبور حداقل باید 8 کاراکتر باشد',
			'max' => 'کلمه عبور نمی تواند بیشتر از 20 کاراکتر باشد',
		],
		're_password' => [
			'same' => 'تکرار کلمه عبور با کلمه عبور برابر نمی باشد',
		],
	],

	//Words
	'words' => [
		'full_name' => 'نام و نام خانوادگی',
		'role' => 'نقش',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [],
];