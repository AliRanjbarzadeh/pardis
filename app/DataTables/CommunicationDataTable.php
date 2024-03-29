<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class CommunicationDataTable extends BaseDataTable
{
	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('comminucationTable')
			->ajax([
				'url' => route('admin.communications.datatable'),
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

			Column::make('title')
				->title(__('admin/communication.fields.title'))
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
}