<?php

return [
	'singular' => '',
	'plural' => '',

	//Fields
	'fields' => [],

	//Errors
	'errors' => [],

	//Words
	'words' => [],

	//Actions
	'actions' => [
		'approve' => '<a href="javascript:void(0)" class=":className" data-url=":link" data-approve="true" onclick="approveItem(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="تایید کردن"><i class=":icon"></i></a>',
		'reject' => '<a href="javascript:void(0)" class=":className" data-url=":link" data-reject="true" onclick="rejectItem(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="رد کردن"><i class=":icon"></i></a>',
		'comments' => '<a href=":link" class=":className" data-bs-toggle="tooltip" data-bs-placement="top" title="نظرات کاربران"><i class=":icon"></i></a>',
		'edit' => '<a href=":link" class=":className" data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش"><i class=":icon"></i></a>',
		'delete' => '<a href="javascript:void(0)" class=":className" data-url=":link" data-delete="true" onclick="deleteItem(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف"><i class=":icon"></i></a>',
	],

	//Sentences
	'sentences' => [],
];