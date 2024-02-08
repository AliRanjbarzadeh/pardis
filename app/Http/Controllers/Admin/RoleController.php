<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\RoleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	public function __construct(
		protected RoleService       $service,
		protected PermissionService $permissionService,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request, RoleDataTable $dataTable)
	{
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('name', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$permissionCategories = $this->permissionService->categories();

		return view('admin.contents.role.create', compact('permissionCategories'));
	}

	public function store(RoleRequest $request)
	{
		$dto = RoleDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.roles.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Role $role)
	{
		$role->load('permissions');
		$permissionCategories = $this->permissionService->categories();

		return view('admin.contents.role.edit', compact('role', 'permissionCategories'));
	}

	public function update(RoleRequest $request, Role $role)
	{
		$dto = RoleDto::fromRequest($request);
		if ($this->service->update($role, $dto)) {
			return redirect(route('admin.roles.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Role $role)
	{
		if ($role->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
