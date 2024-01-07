<?php

namespace App\Http\Controllers\Front;

use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Services\ClinicService;
use App\Services\PageService;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
	public function __construct(
		protected ClinicService $service,
		protected PageService   $pageService,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request)
	{
		$page = $this->pageService->find(PageTypeEnum::Clinics, ['metas', 'seo']);

		//set seo items
		$this->setSeo($page->seo);
		$this->setPageTitle($page->seo->title);

		$clinics = $this->service->paginated(
			perPage: $page->getMetaValue('items_per_page'),
			term: $request->input('search')
		);

		return view('front.contents.clinics.index', compact('page', 'clinics'));
	}

	public function show(string $seoLink)
	{
		$clinic = $this->service->findByLink($seoLink);

		//set for breadcrumb
		$this->setModel($clinic);
		$this->setPageTitle($clinic->seo->title);

		//set seo items
		$this->setSeo($clinic->seo);
		$this->setPageTitle($clinic->seo->title);

		return view('front.contents.clinics.detail', compact('clinic'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
