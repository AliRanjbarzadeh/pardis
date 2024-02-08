<?php

namespace App\Services;

use App\Facades\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Yajra\DataTables\EloquentDatatable;
use Yajra\DataTables\Facades\DataTables;

class DatatableService
{
	private array $permissions = [];

	public function setPermissions(array $permissions): static
	{
		$this->permissions = $permissions;

		return $this;
	}

	public function datatable($query, string $name, bool $hasDefaultActions = true, ?array $customActions = null, ?array $urlParams = null, bool $hasPriority = false, array $defaultActions = ['edit', 'delete']): EloquentDatatable
	{
		$datatable = DataTables::eloquent($query)
			->addIndexColumn()
			->setRowId('id')
			->orderColumn('priority', function ($query, $order) {
				$query->orderBy('priority', $order);
			});

		$actions = $this->getDefaultActions(
			name: $name,
			hasDefaultActions: $hasDefaultActions,
			defaultActions: $defaultActions
		);

		if (!is_null($customActions)) {
			$actions = array_merge($customActions, $actions);
		}

		if (!empty($actions)) {
			$datatable = $datatable->addColumn('action', function (Model $model) use ($actions, $urlParams) {
				foreach ($actions as $key => $action) {
					if (isset($action['url'])) {
						$params = [$model];
						if (isset($action['parent'])) {
							$params[] = $action['parent'];
						}
						if (isset($action['parents'])) {
							$params = array_merge($action['parents'], $params);
						}
						if (!is_null($urlParams)) {
							$params = array_merge($urlParams, $params);
						}
						$actions[$key]['url'] = route($action['url'], $params);
					}

					if (isset($action['permKey']) && !$this->checkPermission($action['permKey'])) {
						unset($actions[$key]);
					}
				}

				return view('datatables::actions', compact('actions'));
			});
		}

		if ($hasPriority) {
			$datatable = $datatable->addColumn('priority', function (Model $model) {
				return view('datatables::priority', compact('model'))->render();
			});
		}

		return $datatable;
	}

	public function getDefaultActions(string $name, bool $hasDefaultActions = true, array $defaultActions = ['edit', 'delete']): array
	{
		if (!$hasDefaultActions) {
			return [];
		}

		$actions = [];


		if (in_array('edit', $defaultActions)) {
			$actions[] = [
				'title' => __('admin/global.fields.edit'),
				'url' => "admin.$name.edit",
				'icon' => 'bx bx-edit-alt',
				'isButton' => false,
				'permKey' => 'edit',
			];
		}

		if (in_array('delete', $defaultActions)) {
			$actions[] = [
				'title' => __('admin/global.actions.delete'),
				'url' => "admin.$name.destroy",
				'icon' => 'bx bx-trash text-danger',
				'onclick' => 'deleteItem(this);',
				'isButton' => true,
				'permKey' => 'destroy',
			];
		}

		return $actions;
	}

	private function checkPermission($permissionKey): bool
	{
		if (!isset($this->permissions[$permissionKey])) {
			return true;
		}
		return Permission::can($this->permissions[$permissionKey]);
	}
}