<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class CategoryChildDataTable extends BaseDataTable
{
	private string $type;
	private int $parent;

	public function getType(): string
	{
		return $this->type;
	}

	public function setType(string $type): void
	{
		$this->type = $type;
	}

	public function getParent(): int
	{
		return $this->parent;
	}

	public function setParent(int $parent): void
	{
		$this->parent = $parent;
	}

	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('categoryChildTable')
			->ajax([
				'url' => route('admin.categories.' . $this->getType() . '.children.datatable', [$this->getParent()]),
				'type' => 'post',
				'data' => 'function(d) {
					if (typeof addFiltersToData === "function") {
						addFiltersToData(d);
					}
				}',
			])
			->orderBy(2, 'asc');
	}

	public function getColumns(): array
	{
		return [
			Column::make('loop_iterator')
				->title(__('admin/global.fields.index'))
				->width(20)
				->orderable(false)
				->searchable(false),

			Column::make('name')
				->title(__('admin/category.fields.name'))
				->orderable(false)
				->exportable()
				->printable()
				->type('text'),

			Column::make('priority')
				->title(__('admin/global.fields.priority'))
				->orderable()
				->exportable()
				->printable()
				->searchable(false),

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

	public function getActionLinks(): array
	{
		return [
			[
				'title' => __('admin/category.actions.children.create'),
				'href' => route('admin.categories.' . $this->getType() . '.children.create', $this->getParent()),
				'class' => 'btn-primary',
				'icon' => 'message-square-add',
			],
		];
	}
}