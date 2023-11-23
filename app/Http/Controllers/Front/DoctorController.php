<?php

namespace App\Http\Controllers\Front;

use App\Enums\PageTypeEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Services\DoctorService;
use App\Services\PageService;
use App\Services\SpecialityService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
	public function __construct(
		protected DoctorService     $service,
		protected PageService       $pageService,
		protected SpecialityService $specialityService,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request)
	{
		$page = $this->pageService->find(PageTypeEnum::Doctors, ['metas', 'seo']);

		//set seo items
		$this->setSeo($page->seo);

		$doctors = $this->service->paginated(
			perPage: $page->getMetaValue('items_per_page'),
			term: $request->input('search')
		);

		$specialities = $this->specialityService->all();

		return view('front.contents.doctors.index', compact('page', 'doctors', 'specialities'));
	}

	public function show(Doctor $doctor, string $seoLink)
	{
		$doctor->load(['seo', 'media', 'metas', 'insurances', 'blogs', 'contacts', 'specialities', 'socialNetworks',
			'clinics' => function ($query) {
				$query->with(['seo', 'media']);
			},
			'comments' => function ($query) {
				$query->where('status', '=', StatusEnum::Approved)
					->latest();
			},
		])->loadCount([
			'comments' => function ($query) {
				$query->where('status', '=', StatusEnum::Approved);
			},
		]);

		//set seo items
		$this->setSeo($doctor->seo);

		return view('front.contents.doctors.detail', compact('doctor'));
	}

	public function category(Request $request, Speciality $speciality, string $seoLink)
	{
		$page = $this->pageService->find(PageTypeEnum::Doctors, ['metas', 'seo']);

		$speciality->load(['seo']);

		//set seo items
		$this->setSeo($speciality->seo);

		$doctors = $this->service->paginated(
			perPage: $page->getMetaValue('items_per_page'),
			term: $request->input('search'),
			speciality: $speciality
		);

		$specialities = $this->specialityService->all();

		return view('front.contents.doctors.index', compact('page', 'doctors', 'specialities'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
