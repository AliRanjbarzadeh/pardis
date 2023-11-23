<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InsuranceDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\InsuranceDto;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\InsuranceCreateRequest;
use App\Http\Requests\Admin\InsuranceEditRequest;
use App\Models\Insurance;
use App\Services\CategoryService;
use App\Services\InsuranceService;
use Illuminate\Support\Facades\View;

class InsuranceController extends Controller
{
	public function __construct(
		protected InsuranceService $service,
		protected CategoryService  $categoryService,
	)
	{
		View::share('title', __('admin/insurance.plural'));
	}

	/*==================Index====================*/
	public function index(InsuranceDataTable $dataTable)
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
		$categories = $this->categoryService->all(TypeEnum::Insurance, true);
		return view('admin.contents.insurance.create', compact('categories'));
	}

	public function store(InsuranceCreateRequest $request)
	{
		$dto = InsuranceDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.insurances.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Insurance $insurance)
	{
		$insurance->load(['media', 'categories']);
		$categories = $this->categoryService->all(TypeEnum::Insurance, true);

		return view('admin.contents.insurance.edit', compact('insurance', 'categories'));
	}

	public function update(InsuranceEditRequest $request, Insurance $insurance)
	{
		$dto = InsuranceDto::fromRequest($request);
		if ($this->service->update($insurance, $dto)) {
			return redirect(route('admin.insurances.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Insurance $insurance)
	{
		if ($insurance->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
