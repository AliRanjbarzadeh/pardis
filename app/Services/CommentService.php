<?php

namespace App\Services;

use App\DataTransferObjects\CommentDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Enums\CommentTypeEnum;
use App\Enums\StatusEnum;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CommentService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function allDatatable(DatatablesFilterDto $dto): JsonResponse
	{
		$comments = Comment::query()
			->where('model_type', '=', $this->getModelType($dto->type))
			->regexpSearch($dto->term, ['full_name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->statusSearch($dto->status)
			->with('commentable');

		return $this->getDatatable($comments, $dto->type);
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$comments = Comment::query()
			->where('model_type', '=', $this->getModelType($dto->type))
			->where('model_id', '=', $dto->parent)
			->regexpSearch($dto->term, ['full_name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->statusSearch($dto->status)
			->with('commentable');

		return $this->getDatatable($comments, $dto->type);
	}

	public function store(CommentDto $dto, Model $model): bool
	{
		return !is_null($model->addComment($dto));
	}


	/**
	 * @param Comment $comment
	 *
	 * @return bool
	 */
	public function approve(Comment $comment): bool
	{
		return $comment->update(['status' => StatusEnum::Approved]);
	}

	public function reject(Comment $comment): bool
	{
		return $comment->update(['status' => StatusEnum::Rejected]);
	}

	/*==========================Inner Methods=============================*/
	private function getModelType(string $type): string
	{
		switch (CommentTypeEnum::tryFrom($type)) {
			case CommentTypeEnum::Service:
				return Service::class;

			case CommentTypeEnum::Blog:
				return Blog::class;

			case CommentTypeEnum::Doctor:
				return Doctor::class;

			default:
				return '';
		}
	}

	private function getDatatable($query, $type): JsonResponse
	{
		return $this->datatableService->datatable(
			query: $query,
			name: "comments.$type",
			hasDefaultActions: false
		)
			->addColumn('body', function (Comment $comment) {
				return nl2br($comment->body);
			})
			->addColumn('action', function (Comment $comment) use ($type) {
				$actions = [];

				if ($comment->status == StatusEnum::Pending) {
					//approve
					$actions[] = [
						'title' => __('admin/global.words.approve.default'),
						'url' => route('admin.comments.approve', $comment),
						'icon' => 'bx bx-check text-success',
						'onclick' => 'approveItem(this);',
						'isButton' => true,
					];

					//reject
					$actions[] = [
						'title' => __('admin/global.words.reject.default'),
						'url' => route('admin.comments.reject', $comment),
						'icon' => 'bx bx-x text-danger',
						'onclick' => 'rejectItem(this);',
						'isButton' => true,
					];
				}

				if ($comment->status == StatusEnum::Rejected) {
					//show decline reason
					$actions[] = [
						'title' => __('admin/global.words.reject.show'),
						'url' => '',
						'icon' => 'bx bxs-comment-error text-danger',
						'onclick' => 'showItem(this);',
						'isButton' => true,
					];
				}

				//delete
				$actions[] = [
					'title' => __('admin/global.actions.delete'),
					'url' => route("admin.comments.destroy", $comment),
					'icon' => 'bx bx-trash text-danger',
					'onclick' => 'deleteItem(this);',
					'isButton' => true,
				];

				return view('datatables::actions', compact('actions'));
			})
			->toJson();
	}
}