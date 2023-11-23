<?php

namespace App\Http\Controllers\Front;

use App\DataTransferObjects\ContactFormDto;
use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactFormRequest;
use App\Services\ContactService;
use App\Services\GalleryService;
use App\Services\PageService;

class CommonController extends Controller
{
	public function __construct(
		protected PageService    $pageService,
		protected GalleryService $galleryService,
		protected ContactService $contactService,
	)
	{
	}

	/*==================Index====================*/
	public function about()
	{
		$page = $this->pageService->find(type: PageTypeEnum::About, relations: ['media', 'seo']);
		if (is_null($page)) {
			abort(404);
		}

		//set seo items
		$this->setSeo($page->seo);
		$this->setPageTitle($page->seo->title);

		$galleries = $this->galleryService->all();

		return view('front.contents.common.about', compact('page', 'galleries'));
	}

	public function contact()
	{
		$page = $this->pageService->find(PageTypeEnum::Contact, ['metas']);
		if (is_null($page)) {
			abort(404);
		}

		//set seo items
		$this->setSeo($page->seo);
		$this->setPageTitle($page->seo->title);

		return view('front.contents.contact.index', compact('page'));
	}

	/*==================Store====================*/
	public function contact_store(ContactFormRequest $request)
	{
		$dto = ContactFormDto::fromRequest($request);

		if (is_null($this->contactService->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('contact.index'))->with('success', __('admin/global.successes.store'));
	}
}
