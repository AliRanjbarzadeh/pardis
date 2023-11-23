<?php

return [
	'singular' => 'ورود به پنل مدیریت',

	//Fields
	'fields' => [
		'username' => 'نام کاربری',
		'password' => 'کلمه عبور',
		'remember_me' => 'مرا بخاطر بسپار',
	],

	//Placeholders
	'placeholders' => [
		'username' => 'نام کاربری خود را وارد کنید',
		'password' => '**********',
	],

	//Errors
	'validations' => [
		'username' => [
			'required' => 'لطفا نام کاربری را وارد کنید',
		],
		'password' => [
			'required' => 'لطفا کلمه عبور را وارد کنید',
		],

		'exists' => 'نام کاربری و یا کلمه عبور اشتباه می باشد',
	],

	//Words
	'title' => 'به پنل مدیریت خوش آمدید! 👋',
	'description' => 'لطفا اطلاعات حساب کاربری خود را وارد کنید',
	'buttons' => [
		'login' => 'ورود',
	],

	//Actions

	//Sentences

];