<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\SettingDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterSettingRequest;
use App\Services\SettingService;

class FooterController extends Controller
{
	public function __construct(
		protected SettingService $settingService,
	)
	{
	}
	/*==================Index====================*/

	/*==================Create====================*/

	/*==================Edit====================*/

	/*==================Settings====================*/
	public function settings()
	{
		return view('admin.contents.footer.settings');
	}

	public function settingsStore(FooterSettingRequest $request)
	{
		$settings = [
			new SettingDto('footer_description', $request->input('description')),
			new SettingDto('footer_links', $request->input('links', [])),
		];
		$this->settingService->updateOrCreate($settings);
		return redirect(route('admin.footer.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
