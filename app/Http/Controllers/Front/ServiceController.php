<?php

namespace App\Http\Controllers\Front;

use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Services\PageService;
use App\Services\ServiceService;

class ServiceController extends Controller
{
	public function __construct(
		protected ServiceService $service,
		protected PageService    $pageService,
	)
	{
	}

	/*==================Index====================*/
	public function index()
	{
		$page = $this->pageService->find(PageTypeEnum::Services, ['metas', 'seo']);

		//set seo items
		$this->setSeo($page->seo);
		$this->setPageTitle($page->seo->title);

		$services = $this->service->all(
			limit: $page->getMetaValue('items_per_page'),
			relations: ['media', 'seo']
		);

		return view('front.contents.services.index', compact('page', 'services'));
	}

	public function show(string $seoLink)
	{
		$service = $this->service->findByLink($seoLink);

		//set for breadcrumb
		$this->setModel($service);

		//set seo items
		$this->setSeo($service->seo);
		$this->setPageTitle($service->seo->title);

		return view('front.contents.services.detail', compact('service'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
