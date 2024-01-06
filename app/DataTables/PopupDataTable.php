<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;

class PopupDataTable extends BaseDataTable
{
	public function html(): HtmlBuilder
	{
		return parent::html()
			->setTableId('popupTable')
			->ajax([
				'url' => route('admin.popups.datatable'),
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

			Column::make('title')
				->title(__('admin/popup.fields.title'))
				->orderable(false)
				->exportable()
				->printable()
				->searchable()
				->type('text'),

			Column::make('type')
				->title(__('admin/popup.fields.type'))
				->orderable(false)
				->exportable()
				->printable()
				->searchable(false),

			Column::make('status_text', 'status')
				->title(__('admin/popup.fields.status'))
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
}