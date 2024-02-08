<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\DataTransferObjects\AdminDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Models\Admin;
use App\Services\AdminService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct(
		protected AdminService $service,
		protected RoleService  $roleService,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request, AdminDataTable $dataTable)
	{
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			name: $request->post('name', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
			customColumns: [
				'username' => $request->post('username'),
			]
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$roles = $this->roleService->all();

		return view('admin.contents.admin.create', compact('roles'));
	}

	public function store(AdminRequest $request)
	{
		$dto = AdminDto::fromRequest($request);

		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.admins.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Admin $admin)
	{
		$roles = $this->roleService->all();

		return view('admin.contents.admin.edit', compact('admin', 'roles'));
	}

	public function update(AdminRequest $request, Admin $admin)
	{
		$dto = AdminDto::fromRequest($request);
		if ($this->service->update($admin, $dto)) {
			return redirect(route('admin.admins.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Admin $admin)
	{
		if ($admin->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
