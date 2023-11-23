<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClinicDataTable;
use App\DataTransferObjects\ClinicDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PageDto;
use App\DataTransferObjects\SeoDto;
use App\Enums\PageTypeEnum;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClinicCreateRequest;
use App\Http\Requests\Admin\ClinicEditRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Clinic;
use App\Services\ClinicService;
use App\Services\InsuranceService;
use App\Services\PageService;
use Illuminate\Support\Facades\View;

class ClinicController extends Controller
{
	public function __construct(
		protected ClinicService    $service,
		protected InsuranceService $insuranceService,
		protected PageService      $pageService,
	)
	{
		View::share('title', __('admin/clinic.plural'));
	}

	/*==================Index====================*/
	public function index(ClinicDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Clinic::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('title', ''),
			fromDate: $request->post('from_created_at', ''),
			toDate: $request->post('to_created_at', ''),
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$insurances = $this->insuranceService->all();

		return view('admin.contents.clinic.create', compact('insurances'));
	}

	public function store(ClinicCreateRequest $request)
	{
		$dto = (new ClinicDto(
			title: $request->input('title'),
			description: $request->input('description'),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage')
		))->setMedia(General::fromJson($request->input('images'), true))
			->setInsurances($request->input('insurances'))
			->setWorkHours($request->input('work_hours'))
			->setContacts($request->input('contact'));

		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.store')]);
		}

		return redirect(route('admin.clinics.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Clinic $clinic)
	{
		$clinic->load(['insurances', 'seo', 'media', 'contacts']);

		$insurances = $this->insuranceService->all();

		return view('admin.contents.clinic.edit', compact('insurances', 'clinic'));
	}

	public function update(ClinicEditRequest $request, Clinic $clinic)
	{
		$dto = (new ClinicDto(
			title: $request->input('title'),
			description: $request->input('description'),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage')
		))->setMedia(General::fromJson($request->input('images'), true))
			->setInsurances($request->input('insurances'))
			->setWorkHours($request->input('work_hours'))
			->setContacts($request->input('contact'));

		$clinic->load(['insurances', 'seo', 'media', 'contacts']);
		if (is_null($this->service->update($clinic, $dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.update')]);
		}

		return redirect(route('admin.clinics.index'))->with('success', __('admin/global.successes.update'));
	}

	public function destroy(Clinic $clinic)
	{
		if ($clinic->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Clinics, ['metas']);
		return view('admin.contents.clinic.settings', compact('page'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Clinics)
			->setMetas($request->input('metas'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.clinics.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
