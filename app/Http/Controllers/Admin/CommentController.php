<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CommentAllDataTable;
use App\DataTables\CommentDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
	public function __construct(
		protected CommentService $service,
	)
	{
	}

	/*==================All====================*/
	public function all(Request $request, CommentAllDataTable $dataTable)
	{
		$dataTable->setType($request->segment(2));
		$dataTable->setCommentable([
			'title' => __('admin/' . Str::singular($request->segment(2)) . '.fields.dataTable.title'),
			'model_key' => __('admin/' . Str::singular($request->segment(2)) . '.fields.dataTable.model_key'),
		]);
		return $dataTable->render('admin.contents.datatable');
	}

	public function allDatatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('full_name', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
			status: $request->post('status'),
			type: $request->segment(2),
		);
		return $this->service->allDatatable($dto);
	}

	/*==================Index====================*/
	public function index(Request $request, int $parent, CommentDataTable $dataTable)
	{
		$dataTable->setType($request->segment(2));
		$dataTable->setParentId($parent);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request, $parent)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('full_name', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
			status: $request->post('status'),
			type: $request->segment(2),
			parent: $parent,
		);
		return $this->service->datatable($dto);
	}

	/*==================Create====================*/

	/*==================Edit====================*/
	public function approve(Comment $comment)
	{
		if ($this->service->approve($comment)) {
			return response()->json(['message' => __('admin/global.successes.update')]);
		}
		return response()->json(['message' => __('admin/global.errors.update')], 400);
	}

	public function reject(Comment $comment)
	{
		if ($this->service->reject($comment)) {
			return response()->json(['message' => __('admin/global.successes.update')]);
		}
		return response()->json(['message' => __('admin/global.errors.update')], 400);
	}

	public function destroy(Comment $comment)
	{
		if ($comment->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
