<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\MediaDto;
use Illuminate\Http\Request;

class BugController extends Controller
{
	public function index()
	{
		$test = collect([
			new MediaDto(1, 'test1'),
			new MediaDto(2, 'test2'),
			new MediaDto(3, 'test3'),
			new MediaDto(4, 'test4'),
			new MediaDto(5, 'test5'),
		]);

		return $test->pluck('name')->toArray();
	}
}
