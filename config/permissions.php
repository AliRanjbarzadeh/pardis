<?php

use Illuminate\Support\Arr;

$basePerms = [
	'create' => 'تعریف',
	'edit' => 'ویرایش',
	'destroy' => 'حذف',
	'index' => 'آرشیو',
	'show' => 'مشاهده',
];
$changeStatusPerm = [
	'changeStatus' => 'تغییر وضعیت',
];
$settingsPerm = [
	'settings' => 'تنظیمات',
];
$approveRejectPerm = [
	'approve' => 'تایید کردن',
	'reject' => 'رد کردن',
];

return [
	[
		'name' => 'بیمه ها',
		'permissions' => [
			'insurances' => Arr::except($basePerms, ['show']),
			'related_permissions' => [
				'categories' => [
					'name' => 'دسته بندی ها',
					'permissions' => Arr::except($basePerms, ['show']),
					'related_permissions' => [
						'children' => [
							'name' => 'زیر دسته بندی ها',
							'permissions' => Arr::except($basePerms, ['show']),
						],
					],
				],
			],
		],
	],
	[
		'name' => 'تخصص ها',
		'permissions' => [
			'specialities' => Arr::except($basePerms, ['show']),
		],
	],
	[
		'name' => 'مقالات',
		'permissions' => [
			'blogs' => array_merge(Arr::except($basePerms, ['show']), $settingsPerm),
			'related_permissions' => [
				'categories' => [
					'name' => 'دسته بندی ها',
					'permissions' => Arr::except($basePerms, ['show']),
				],
				'comments' => [
					'name' => 'نظرات',
					'permissions' => array_merge(Arr::only($basePerms, ['destroy']), $approveRejectPerm),
				],
			],
		],
	],
	[
		'name' => 'خدمات',
		'permissions' => [
			'services' => array_merge(Arr::except($basePerms, ['show']), $settingsPerm),
		],
	],
	[
		'name' => 'کلینیک ها',
		'permissions' => [
			'clinics' => array_merge(Arr::except($basePerms, ['show']), $settingsPerm),
		],
	],
	[
		'name' => 'پزشکان',
		'permissions' => [
			'doctors' => array_merge(Arr::except($basePerms, ['show']), $settingsPerm),
			'related_permissions' => [
				'comments' => [
					'name' => 'نظرات',
					'permissions' => array_merge(Arr::only($basePerms, ['destroy']), $approveRejectPerm),
				],
			],
		],
	],
	[
		'name' => 'گالری تصاویر',
		'permissions' => [
			'galleries' => Arr::except($basePerms, ['show']),
			'related_permissions' => [
				'categories' => [
					'name' => 'دسته بندی ها',
					'permissions' => Arr::except($basePerms, ['show']),
				],
			],
		],
	],
	[
		'name' => 'رضایت مندی مشتریان',
		'permissions' => [
			'testimonials' => Arr::except($basePerms, ['show']),
		],
	],
	[
		'name' => 'پاپ آپ ها',
		'permissions' => [
			'popups' => Arr::except($basePerms, ['show']),
		],
	],
	[
		'name' => 'راه های ارتباطی',
		'permissions' => [
			'communications' => Arr::except($basePerms, ['show']),
		],
	],
	[
		'name' => 'خانه',
		'permissions' => [
			'home' => $settingsPerm,
			'related_permissions' => [
				'sliders' => [
					'name' => 'اسلایدرها',
					'permissions' => Arr::except($basePerms, ['show']),
				],
			],
		],
	],
	[
		'name' => 'درباره ما',
		'permissions' => [
			'about' => Arr::only($basePerms, ['edit']),
		],
	],
	[
		'name' => 'تماس با ما',
		'permissions' => [
			'contacts' => array_merge(Arr::only($basePerms, ['index', 'show']), $settingsPerm),
			'related_permissions' => [
				'sliders' => [
					'name' => 'اسلایدرها',
					'permissions' => Arr::except($basePerms, ['show']),
				],
			],
		],
	],
	[
		'name' => 'تنظیمات عمومی',
		'permissions' => [
			'settings' => [
				'footer' => 'فوتر',
			],
		],
	],
];

