<?php

return [
	/**
	 * subSizes for the uploaded image.
	 * if the crop option is set to false, the image will be resized keeping the aspect ration according to the width and height
	 * but if the crop option is set to true, the image will be cropped with the width and height provided.
	 * you can add any size you want
	 */
	'sub_sizes' => [
		'thumbnail' => [
			'width' => 200,
			'height' => 200,
			'crop' => true,
		],
		'medium' => [
			'width' => 600,
			'height' => 600,
			'crop' => false,
		],
		'large' => [
			'width' => 1024,
			'height' => 1024,
			'crop' => false,
		],
	],

	/**
	 * supported mime types
	 * you can add the extensions you want to each category. or add a new category
	 * do not remove these default categories
	 */
	'mime_types' => [
		'image/*' => '.jpg,.png,.jpeg,.bmp,.gif',
		'video/*' => '.mp4,.mov',
		'audio/*' => '.mp3',
		'other' => '.pdf,.zip',
	],

	/**
	 * set upload folder
	 */
	'upload_folder' => env('MEDIA_UPLOAD_FOLDER', 'local'),

	/**
	 * set disk
	 */
	'disk' => env('MEDIA_DISK', 'local'),

	/**
	 * set middleware for media route.
	 */
	'middleware' => [],

	/**
	 * media URL.
	 * default is url()
	 */
	'media_url' => '',

	/**
	 * default locale
	 * available locales: en, fa
	 */
	'locale' => 'fa',
];