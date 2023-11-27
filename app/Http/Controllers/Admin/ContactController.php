<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactFormDataTable;
use App\DataTransferObjects\ContactFormResponseDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PageDto;
use App\Enums\PageTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactFormResponseRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Models\ContactForm;
use App\Services\ContactService;
use App\Services\PageService;
use App\Services\SocialNetworkTypeService;

class ContactController extends Controller
{
	public function __construct(
		protected ContactService           $service,
		protected PageService              $pageService,
		protected SocialNetworkTypeService $socialNetworkTypeService,
	)
	{
	}

	/*==================Index====================*/
	public function index(ContactFormDataTable $dataTable)
	{
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('subject', ''),
			name: $request->post('name', ''),
			email: $request->post('email', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
		);
		return $this->service->datatable($dto);
	}

	public function show(ContactForm $contact)
	{
		return view('admin.contents.contact.answer', compact('contact'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
	public function update(ContactFormResponseRequest $request, ContactForm $contact)
	{
		if (!$this->service->answer(new ContactFormResponseDto($request->input('answer')), $contact)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.contacts.index'))->with('success', __('admin/global.successes.store'));
	}

	public function destroy(ContactForm $contact)
	{
		if ($contact->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Contact, ['metas', 'socialNetworks']);

		$socialNetworkTypes = $this->socialNetworkTypeService->all();

		return view('admin.contents.contact.settings', compact('page', 'socialNetworkTypes'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Contact)
			->setMetas($request->input('metas'))
			->setSocialNetworks($request->input('social_networks'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.contacts.settings.index'))->with('success', __('admin/global.successes.store'));
	}
}
