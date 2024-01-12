<?php

return [
	'singular' => 'بۆچوون',
	'plural' => 'کۆمێنتەکان',

	//Fields
	'fields' => [
		'full_name' => 'ناوی یەکەم و ناوی کۆتایی',
		'email' => 'ئیمەیڵ',
		'mobile' => 'مۆبایل',
		'body' => 'سەرنج',
	],

	//Placeholders
	'placeholders' => [
		'full_name' => 'بۆ نموونە: رضا کمالزاده',
		'email' => 'example@domain.com',
		'mobile' => 'مۆبایل',
		'body' => 'دەبێت بەلایەنی کەمەوە ١٠ نامە بنووسیت ...',
	],

	//Errors
	'errors' => [
		'full_name' => [
			'required' => 'تکایە ناوی یەکەم و ناوی کۆتایی خۆت بنووسە',
		],
		'email' => [
			'required' => 'تکایە ناونیشانی ئیمەیڵەکەت بنووسە',
		],
		'mobile' => [
			'required' => 'تکایە مۆبایلەکە داخڵ بکە',
		],
		'body' => [
			'required' => 'تکایە دەقی کۆمێنتەکە داخڵ بکە',
			'min' => 'دەقی کۆمێنت ناتوانێت لە ١٠ پیت کەمتر بێت',
		],
		'model_type' => [
			'required' => 'هەڵەیەک ڕوویدا، تکایە دووبارە هەوڵبدەرەوە',
		],
	],

	//Words
	'words' => [
		'user' => 'سەرنجی بەکارهێنەران',
		'save' => 'کۆمێنتێک تۆمار بکە',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [
		'privacy' => 'ناونیشانی ئیمەیڵەکەت بڵاو ناکرێتەوە.',
	],
];