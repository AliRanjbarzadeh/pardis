<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\SliderDto;
use App\Enums\SliderPageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderEditRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
	public function __construct(
		protected SliderService $service,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request, SliderDataTable $dataTable)
	{
		$dataTable->setType($request->segment(2));
		$dataTable->addPriorityButton(route('admin.priority'), Slider::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('title', ''),
			fromDate: $request->post('from_created_at', ''),
			toDate: $request->post('to_created_at', ''),
			type: $request->segment(2)
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		return view('admin.contents.slider.create');
	}

	public function store(SliderCreateRequest $request)
	{
		$dto = SliderDto::fromRequest($request, SliderPageEnum::tryFrom($request->segment(2)));
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.' . $request->segment(2) . '.sliders.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Slider $slider)
	{
		return view('admin.contents.slider.edit', compact('slider'));
	}

	public function update(SliderEditRequest $request, Slider $slider)
	{
		$dto = SliderDto::fromRequest($request, SliderPageEnum::tryFrom($request->segment(2)));
		if ($this->service->update($slider, $dto)) {
			return redirect(route('admin.' . $request->segment(2) . '.sliders.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Slider $slider)
	{
		if ($slider->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
