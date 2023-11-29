<?php

namespace App\Http\Controllers\Front;

use App\DataTransferObjects\CommentDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function __construct(
		protected CommentService $service,
	)
	{
	}

	/*==================Index====================*/

	/*==================Create====================*/
	public function store(CommentRequest $request, int $modelId)
	{
		$model = $request->input('model_type');
		$commentable = $model::find($modelId);

		$dto = CommentDto::fromRequest($request);

		if (is_null($this->service->store($dto, $commentable))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return back()->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
}
