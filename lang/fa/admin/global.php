<?php

return [
	'app' => [
		'title' => 'کلینیک پردیس',
	],

	//Fields
	'fields' => [
		'index' => '#',
		'tools' => 'ابزار',
		'create' => 'تعریف',
		'edit' => 'ویرایش',
		'archive' => 'آرشیو',
		'priority' => 'اولویت',
		'search' => 'جستجو',
		'select' => [
			'image' => 'تصویر را انتخاب کنید',
			'medium' => 'رسانه را انتخاب کنید',
		],
		'created_at' => 'تاریخ ایجاد',
		'updated_at' => 'تاریخ بروزرسانی',
		'deleted_at' => 'تاریخ حذف',
		'image' => [
			'feature' => 'تصویر شاخص',
		],
		'medium' => [
			'input' => 'رسانه',
		],
	],

	//Placeholders
	'placeholders' => [
		'date' => 'مثلا: 1402/01/01',
		'time' => 'مثلا: 09:00',
		'priority' => 'مثلا: 1',
		'search' => 'مثلا: بلوار رحمت',
	],

	//Errors
	'errors' => [
		'not_found' => 'موردی یافت نشد',
		'store' => 'ذخیره نشد، لطفا دوباره تلاش کنید',
		'update' => 'بروزرسانی نشد، لطفا دوباره تلاش کنید',
		'delete' => 'حذف نشد، لطفا دوباره تلاش کنید',
		'approve' => 'تایید نشد، لطفا دوباره تلاش کنید',
		'reject' => 'رد نشد، لطفا دوباره تلاش کنید',
		'feature_image' => [
			'required' => 'لطفا تصویر شاخص را انتخاب کنید',
			'file' => 'تصویر شاخص باید از نوع فایل باشد',
		],
		'icon_image' => [
			'required' => 'لطفا آیکون را انتخاب کنید',
		],
		'priority' => [
			'required' => 'لطفا اولویت را وارد کنید',
		],
	],

	//Successes
	'successes' => [
		'store' => 'با موفقیت ذخیره شد',
		'update' => 'با موفقیت بروزرسانی شد',
		'delete' => 'با موفقیت حذف شد',
	],

	//Words
	'words' => [
		'all' => 'همه',
		'some' => 'تعداد مشخص',
		'items_to_show' => 'تعداد نمایش',
		'number' => 'تعداد',
		'choose' => 'انتخاب کنید',
		'choose_or_create' => 'انتخاب کنید و یا مورد جدید ثبت کنید',
		'until' => 'تا',
		'basic_information' => 'اطلاعات پایه',
		'modules' => 'ماژول ها',
		'delete' => [
			'default' => 'حذف کردن',
			'filter' => 'حذف فیلترها',
		],
		'approve' => [
			'default' => 'تایید کردن',
		],
		'reject' => [
			'default' => 'رد کردن',
			'show' => 'دلیل رد',
		],
		'image' => [
			'singular' => 'تصویر',
			'plural' => 'تصاویر',
			'feature' => 'انتخاب تصویر شاخص',
			'icon' => 'انتخاب آیکون',
		],
	],

	//Actions
	'actions' => [
		'definition' => 'تعریف',
		'create' => 'ایجاد',
		'add' => 'اضافه کردن',
		'save' => 'ذخیره',
		'delete' => 'حذف',
		'update' => 'بروزرسانی',
		'search' => 'جستجو',
		'close' => 'بستن',
		'priority' => [
			'update' => 'بروزرسانی اولویت',
		],
	],

	//Sentences
	'sentences' => [
		'delete' => [
			'default' => [
				'title' => 'حذف داده',
				'description' => 'آیا برای حذف اطمینان دارید؟',
			],
		],
		'approve' => [
			'default' => [
				'title' => 'تایید کردن',
				'description' => 'آیا برای تایید کردن اطمینان دارید؟',
			],
		],
		'reject' => [
			'default' => [
				'title' => 'رد کردن',
				'description' => 'آیا برای رد کردن اطمینان دارید؟',
			],
		],
		'type_on_or_more' => 'لطفا یک یا چند حرف بنویسید',
	],
];