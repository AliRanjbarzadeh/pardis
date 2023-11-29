<?php

namespace App\DataTables;

use App\Enums\StatusEnum;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class CommentAllDataTable extends BaseDataTable
{
	private string $type;
	private array $commentable;

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type): void
	{
		$this->type = $type;
	}

	public function setCommentable(array $commentable): void
	{
		$this->commentable = $commentable;
	}

	public function getCommentable(): array
	{
		return $this->commentable;
	}

	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('commentAllTable')
			->ajax([
				'url' => route('admin.' . $this->getType() . '.comments.all.datatable'),
				'type' => 'post',
				'data' => 'function(d) {
					if (typeof addFiltersToData === "function") {
						addFiltersToData(d);
					}
				}',
			])
			->orderBy(5);
	}

	public function getColumns(): array
	{
		return [
			Column::make('loop_iterator')
				->title(__('admin/global.fields.index'))
				->width(20)
				->orderable(false)
				->searchable(false),

			Column::make('full_name')
				->title(__('admin/comment.fields.full_name'))
				->orderable(false)
				->exportable()
				->printable()
				->type('text'),

			Column::make('body')
				->title(__('admin/comment.fields.body'))
				->orderable(false)
				->exportable()
				->printable()
				->searchable(false),

			Column::make($this->getCommentable()['model_key'])
				->title($this->getCommentable()['title'])
				->orderable(false)
				->exportable()
				->printable()
				->searchable(false),

			Column::make('status_text', 'status')
				->title(__('admin/status.singular'))
				->orderable(false)
				->exportable()
				->printable()
				->type('status'),

			Column::make('created_at_jalali', 'created_at')
				->title(__('admin/global.fields.created_at'))
				->orderable()
				->exportable()
				->printable()
				->type('date'),

			Column::make('action')
				->title(__('admin/global.fields.tools'))
				->orderable(false)
				->printable(false)
				->exportable(false)
				->searchable(false),
		];
	}

	public function getStatuses(): Collection
	{
		$statuses = collect();

		$statuses->put(StatusEnum::Pending->value, __('admin/status.fields.pending'));
		$statuses->put(StatusEnum::Approved->value, __('admin/status.fields.approved'));
		$statuses->put(StatusEnum::Rejected->value, __('admin/status.fields.rejected'));

		return $statuses;
	}
}