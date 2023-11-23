<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
	private array $actionButtons;
	protected Collection $categories;

	public function __construct()
	{
		parent::__construct();

		$this->actionButtons = [
			[
				'title' => __('admin/global.words.delete.filter'),
				'action' => 'delete-filters',
				'class' => 'btn-danger',
				'icon' => 'trash',
			],
		];
	}

	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return (new EloquentDataTable($query))->setRowId('id');
	}

	public function query(Model $model): QueryBuilder
	{
		return $model->newQuery();
	}

	public function html(): HtmlBuilder
	{
		return $this->builder()
			->parameters([
				'searching' => true,
				'drawCallback' => 'function() { $(\'[data-bs-toggle="tooltip"]\').tooltip(); }',
				'initComplete' => 'function(settings) { sessionStorage.setItem(settings.sTableId + "Sort", JSON.stringify(settings.aaSorting)); }',
			])
			->serverSide()
			->columns($this->getColumns())
			->pageLength(Cookie::get('paging', 10))
			->lengthMenu([10, 25, 50, 75, 100, 200, 500, 1000, 2000])
			->searching(false)
			->autoWidth(false)
			->ordering()
			->responsive()
			->addTableClass("table-striped table-hover")
			->dom('lfrt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>')
			->language(asset('assets/admin/vendor/libs/datatables/languages/fa.json'));
	}

	/**
	 * Process dataTables needed render output.
	 *
	 * @phpstan-param view-string|null $view
	 *
	 * @param string|null $view
	 * @param array $data
	 * @param array $mergeData
	 *
	 * @return mixed
	 */
	public function render(string $view = null, array $data = [], array $mergeData = []): mixed
	{
		$mergeData = array_merge($mergeData, ['filters' => $this->getFilterBlock()]);
		return parent::render($view, $data, $mergeData);
	}

	public function getColumns(): array
	{
		return [];
	}

	public function getStatuses(): Collection
	{
		return collect();
	}

	public function getCategories(): Collection
	{
		return $this->categories ?? collect();
	}

	public function setCategories(Collection $categories): void
	{
		$this->categories = $categories;
	}

	public function addActionButton(array $button): void
	{
		$this->actionButtons[] = $button;
	}

	public function addPriorityButton(string $url, string $model): void
	{
		$this->actionButtons[] = [
			'title' => __('admin/global.actions.priority.update'),
			'action' => 'update-priority',
			'url' => $url,
			'model' => $model,
			'class' => 'btn-info',
			'icon' => 'refresh',
		];
	}

	public function getActionLinks(): array
	{
		return [];
	}

	public function getFilterBlock(): string
	{
		$inputs = collect($this->getColumns())->where('searchable', '=', true);

		if ($this->getStatuses()->isNotEmpty()) {
			$inputs->where('type', '=', 'status')
				->map(function ($item) {
					$item->list = $this->getStatuses();
				});
		} else {
			$inputs->forget($inputs->where('type', '=', 'status')->keys());
		}

		if ($this->getCategories()->isNotEmpty()) {
			$inputs->where('type', '=', 'category')
				->map(function ($item) {
					$item->list = $this->getCategories();
				});
		} else {
			$inputs->forget($inputs->where('type', '=', 'category')->keys());
		}

		$buttons = $this->actionButtons;
		$actionLinks = $this->getActionLinks();
		return view('datatables::filters', compact('inputs', 'buttons', 'actionLinks'))->render();
	}
}