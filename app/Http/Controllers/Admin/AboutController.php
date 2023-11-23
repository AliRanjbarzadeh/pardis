<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\PageDto;
use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Services\PageService;

class AboutController extends Controller
{
	public function __construct(
		protected PageService $service,
	)
	{
	}

	/*==================Index====================*/
	public function index()
	{
		$page = $this->service->find(PageTypeEnum::About, ['seo', 'media']);

		return view('admin.contents.common.about', compact('page'));
	}

	/*==================Create====================*/
	public function store(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)->setType(PageTypeEnum::About);
		if ($this->service->updateOrCreate($dto)) {
			return redirect(route('admin.about.index'))->with('success', __('admin/global.successes.store'));
		}
		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
	}

	/*==================Edit====================*/
}
