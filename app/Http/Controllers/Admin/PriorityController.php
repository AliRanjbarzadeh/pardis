<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\PriorityDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PriorityRequest;
use App\Services\PriorityService;

class PriorityController extends Controller
{
	public function __construct(
		protected PriorityService $service,
	)
	{
	}

	/*==================Index====================*/
	public function index(PriorityRequest $request)
	{
		$dto = PriorityDto::fromRequest($request);

		if ($this->service->update($dto)) {
			return response()->json(['message' => __('admin/global.successes.update')]);
		}
		return response()->json(['message' => __('admin/global.errors.update')], 400);
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
