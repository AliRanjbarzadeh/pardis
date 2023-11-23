<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\PageDto;
use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Services\PageService;

class HomeController extends Controller
{
	public function __construct(
		protected PageService $pageService,
	)
	{
	}

	/*==================Index====================*/

	/*==================Create====================*/

	/*==================Edit====================*/

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Home, ['metas']);
		return view('admin.contents.home.settings', compact('page'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Home)
			->setMetas($request->input('metas'))
			->setFaqs($request->input('faqs'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.home.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
