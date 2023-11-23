<?php

namespace App\Http\Controllers\Front;

use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\InsuranceService;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
	public function __construct(
		protected InsuranceService $service,
		protected CategoryService  $categoryService,
	)
	{
	}

	/*==================Index====================*/
	public function index()
	{
		$insurances = $this->service->all(relations: ['categories']);
		$categories = $this->categoryService->all(TypeEnum::Insurance, true);

		return view('front.contents.insurances.index', compact('insurances', 'categories'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
