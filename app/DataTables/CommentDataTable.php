<?php

namespace App\DataTables;

use App\Enums\StatusEnum;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class CommentDataTable extends BaseDataTable
{
	private string $type;
	private int $parentId;

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type): void
	{
		$this->type = $type;
	}

	public function getParentId(): int
	{
		return $this->parentId;
	}

	public function setParentId(int $parentId): void
	{
		$this->parentId = $parentId;
	}

	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('commentTable')
			->ajax([
				'url' => route('admin.' . $this->getType() . '.comments.datatable', $this->getParentId()),
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