<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DoctorDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\DoctorDto;
use App\DataTransferObjects\PageDto;
use App\DataTransferObjects\SeoDto;
use App\Enums\PageTypeEnum;
use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\DoctorCreateRequest;
use App\Http\Requests\Admin\DoctorEditRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Doctor;
use App\Services\ClinicService;
use App\Services\DoctorService;
use App\Services\InsuranceService;
use App\Services\PageService;
use App\Services\SocialNetworkTypeService;
use App\Services\SpecialityService;
use Illuminate\Support\Facades\View;

class DoctorController extends Controller
{
	public function __construct(
		protected DoctorService            $service,
		protected InsuranceService         $insuranceService,
		protected SpecialityService        $specialityService,
		protected ClinicService            $clinicService,
		protected SocialNetworkTypeService $socialNetworkTypeService,
		protected PageService              $pageService,
	)
	{
		View::share('title', __('admin/doctor.plural'));
	}

	/*==================Index====================*/
	public function index(DoctorDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Doctor::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('full_name', ''),
			fromDate: $request->post('from_created_at', ''),
			toDate: $request->post('to_created_at', ''),
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$insurances = $this->insuranceService->all();
		$specialities = $this->specialityService->all();
		$clinics = $this->clinicService->all();
		$socialNetworkTypes = $this->socialNetworkTypeService->all();

		return view('admin.contents.doctor.create', compact('insurances', 'specialities', 'clinics', 'socialNetworkTypes'));
	}

	public function store(DoctorCreateRequest $request)
	{
		$dto = DoctorDto::fromRequest($request)
			->setMedia(General::fromJson($request->input('images'), true))
			->setInsurances($request->input('insurances'))
			->setContacts($request->input('contact'))
			->setSocialNetworks($request->input('social_networks'))
			->setResumes($request->input('resumes'))
			->setWorkHours($request->input('work_hours'));

		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.store')]);
		}

		return redirect(route('admin.doctors.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Doctor $doctor)
	{
		$doctor->load(['insurances', 'seo', 'media', 'contacts', 'specialities', 'clinics', 'socialNetworks', 'metas']);

		$insurances = $this->insuranceService->all();
		$specialities = $this->specialityService->all();
		$clinics = $this->clinicService->all();
		$socialNetworkTypes = $this->socialNetworkTypeService->all();

		return view('admin.contents.doctor.edit', compact('insurances', 'specialities', 'clinics', 'socialNetworkTypes', 'doctor'));
	}

	public function update(DoctorEditRequest $request, Doctor $doctor)
	{
		$dto = DoctorDto::fromRequest($request)
			->setMedia(General::fromJson($request->input('images'), true))
			->setInsurances($request->input('insurances'))
			->setContacts($request->input('contact'))
			->setSocialNetworks($request->input('social_networks'))
			->setResumes($request->input('resumes'))
			->setWorkHours($request->input('work_hours'));

		$doctor->load(['insurances', 'seo', 'media', 'contacts', 'specialities', 'clinics', 'socialNetworks', 'metas']);
		if (is_null($this->service->update($doctor, $dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.update')]);
		}

		return redirect(route('admin.doctors.index'))->with('success', __('admin/global.successes.update'));
	}

	public function destroy(Doctor $doctor)
	{
		if ($doctor->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Doctors, ['metas']);
		return view('admin.contents.doctor.settings', compact('page'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Doctors)
			->setMetas($request->input('metas'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.doctors.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
