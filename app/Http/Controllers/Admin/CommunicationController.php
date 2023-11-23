<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CommunicationDataTable;
use App\DataTransferObjects\CommunicationDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommunicationRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Models\Communication;
use App\Services\CommunicationService;
use Illuminate\Support\Facades\View;

class CommunicationController extends Controller
{
	public function __construct(
		protected CommunicationService $service,
	)
	{
		View::share('title', __('admin/communication.plural'));
	}

	/*==================Index====================*/
	public function index(CommunicationDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Communication::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('title', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
		);
		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		return view('admin.contents.communication.create');
	}

	public function store(CommunicationRequest $request)
	{
		$dto = CommunicationDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.communications.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Communication $communication)
	{
		return view('admin.contents.communication.edit', compact('communication'));
	}

	public function update(CommunicationRequest $request, Communication $communication)
	{
		$dto = CommunicationDto::fromRequest($request);
		if ($this->service->update($communication, $dto)) {
			return redirect(route('admin.communications.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Communication $communication)
	{
		if ($communication->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
