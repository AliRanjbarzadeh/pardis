<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class AdminDataTable extends BaseDataTable
{
	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('adminsTable')
			->ajax([
				'url' => route('admin.admins.datatable'),
				'type' => 'post',
				'data' => 'function(d) {
					if (typeof addFiltersToData === "function") {
						addFiltersToData(d);
					}
				}',
			])
			->orderBy(4);
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
				->title(__('admin/admin.words.full_name'))
				->orderable(false)
				->exportable()
				->printable()
				->type('text'),

			Column::make('username')
				->title(__('admin/admin.fields.username'))
				->orderable(false)
				->exportable()
				->printable()
				->type('text'),

			Column::make('role.name')
				->title(__('admin/admin.words.role'))
				->orderable(false)
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
}