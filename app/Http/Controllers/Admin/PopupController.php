<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PopupDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PopupDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\PopupRequest;
use App\Models\Popup;
use App\Services\PopupService;
use Illuminate\Http\Request;

class PopupController extends Controller
{
	public function __construct(
		protected PopupService $service,
	)
	{
	}

	/*==================Index====================*/
	public function index(PopupDataTable $dataTable)
	{
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
		return view('admin.contents.popup.create');
	}

	public function store(PopupRequest $request)
	{
		$dto = PopupDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.store')]);
		}

		return redirect(route('admin.popups.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Popup $popup)
	{
		$popup->load(['media']);

		return view('admin.contents.popup.edit', compact('popup'));
	}

	public function update(PopupRequest $request, Popup $popup)
	{
		$popup->load(['media']);
		$dto = PopupDto::fromRequest($request);
		if (is_null($this->service->update($popup, $dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.update')]);
		}

		return redirect(route('admin.popups.index'))->with('success', __('admin/global.successes.update'));
	}

	public function changeStatus(Request $request, Popup $popup)
	{
		$dto = PopupDto::fromRequest($request);
		if ($this->service->changeStatus($popup, $dto)) {
			return response()->json(['message' => __('admin/global.successes.update')]);
		}
		return response()->json(['message' => __('admin/global.errors.update')], 400);
	}

	public function destroy(Popup $popup)
	{
		if ($popup->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
