<?php

return [
	'singular' => 'Comment',
	'plural' => 'Comments',

	//Fields
	'fields' => [
		'full_name' => 'First name and Last name',
		'email' => 'E-mail',
		'mobile' => 'Mobile',
		'body' => 'Your comment',
	],

	//Placeholders
	'placeholders' => [
		'full_name' => 'For example: Reza Kamalzadeh',
		'email' => 'example@domain.com',
		'mobile' => 'Mobile',
		'body' => 'You must type at least 10 letters...',
	],

	//Errors
	'errors' => [
		'full_name' => [
			'required' => 'Please enter your first and last name',
		],
		'email' => [
			'required' => 'Please enter your email address',
		],
		'mobile' => [
			'required' => 'Please enter the mobile phone',
		],
		'body' => [
			'required' => 'Please enter the text of the comment',
			'min' => 'Comment text cannot be less than 10 characters',
		],
		'model_type' => [
			'required' => 'An error occurred, please try again',
		],
	],

	//Words
	'words' => [
		'user' => 'User comments',
		'save' => 'Register a comment',
	],

	//Actions
	'actions' => [],

	//Sentences
	'sentences' => [
		'privacy' => 'Your email address will not be published.',
	],
];