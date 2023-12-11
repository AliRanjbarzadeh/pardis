<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PageDto;
use App\DataTransferObjects\SeoDto;
use App\DataTransferObjects\ServiceDto;
use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Requests\Admin\ServiceCreateRequest;
use App\Http\Requests\Admin\ServiceEditRequest;
use App\Models\Service;
use App\Services\PageService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
	public function __construct(
		protected ServiceService $service,
		protected PageService    $pageService,
	)
	{
		View::share('title', __('admin/service.plural'));
	}

	/*==================Index====================*/
	public function index(ServiceDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Service::class);
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
		return view('admin.contents.service.create');
	}

	public function store(ServiceCreateRequest $request)
	{
		$dto = (new ServiceDto(
			title: $request->input('title'),
			description: $request->input('description'),
			fullDescription: $request->input('full_description', ''),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage'),
			iconImage: $request->file('iconImage'),
		));
//			->setMedia(General::fromJson($request->input('images'), true))
//			->setFaqs($request->faqs);

		//save service
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.store')]);
		}

		return redirect(route('admin.services.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Service $service)
	{
		$service->load(['seo', 'media']);

		return view('admin.contents.service.edit', compact('service'));
	}

	public function update(ServiceEditRequest $request, Service $service)
	{
		$dto = (new ServiceDto(
			title: $request->input('title'),
			description: $request->input('description'),
			fullDescription: $request->input('full_description', ''),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage'),
			iconImage: $request->file('iconImage'),
		));
//			->setMedia(General::fromJson($request->input('images'), true))
//			->setFaqs($request->faqs);

		$service->load('seo', 'faqs', 'media');
		if ($this->service->update($service, $dto)) {
			return redirect(route('admin.services.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Service $service)
	{
		if ($service->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Services, ['metas']);
		return view('admin.contents.service.settings', compact('page'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Services)
			->setMetas($request->input('metas'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.services.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
