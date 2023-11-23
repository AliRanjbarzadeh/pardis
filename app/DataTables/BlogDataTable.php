<?php

namespace App\DataTables;

use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class BlogDataTable extends BaseDataTable
{
	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('blogTable')
			->ajax([
				'url' => route('admin.blogs.datatable'),
				'type' => 'post',
				'data' => 'function(d) {
					if (typeof addFiltersToData === "function") {
						addFiltersToData(d);
					}
				}',
			])
			->orderBy(3);
	}

	public function getColumns(): array
	{
		return [
			Column::make('loop_iterator')
				->title(__('admin/global.fields.index'))
				->width(20)
				->orderable(false)
				->searchable(false),

			Column::make('title')
				->title(__('admin/blog.fields.title'))
				->orderable(false)
				->exportable()
				->printable()
				->type('text'),

			Column::make('categories[0].name', 'category_id')
				->title(__('admin/category.singular'))
				->orderable(false)
				->exportable()
				->printable()
				->searchable()
				->type('category'),

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
}