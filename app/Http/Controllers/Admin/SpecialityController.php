<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecialityDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\SeoDto;
use App\DataTransferObjects\SpecialityDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\SpecialityRequest;
use App\Models\Speciality;
use App\Services\SpecialityService;
use Illuminate\Support\Facades\View;

class SpecialityController extends Controller
{
	public function __construct(
		protected SpecialityService $service,
	)
	{
		View::share('title', __('admin/speciality.plural'));
	}

	/*==================Index====================*/
	public function index(SpecialityDataTable $dataTable)
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
		return view('admin.contents.speciality.create');
	}

	public function store(SpecialityRequest $request)
	{
		$dto = new SpecialityDto(
			name: $request->input('name'),
			seo: SeoDto::fromRequest($request)
		);

		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.specialities.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Speciality $speciality)
	{
		return view('admin.contents.speciality.edit', compact('speciality'));
	}

	public function update(SpecialityRequest $request, Speciality $speciality)
	{
		$dto = new SpecialityDto(
			name: $request->input('name'),
			seo: SeoDto::fromRequest($request)
		);

		if ($this->service->update($speciality, $dto)) {
			return redirect(route('admin.specialities.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Speciality $speciality)
	{
		if ($speciality->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
