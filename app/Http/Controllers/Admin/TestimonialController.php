<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TestimonialDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\TestimonialDto;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use Illuminate\Support\Facades\View;

class TestimonialController extends Controller
{
	public function __construct(
		protected TestimonialService $service,
	)
	{
		View::share('title', __('admin/testimonial.plural'));
	}

	/*==================Index====================*/
	public function index(TestimonialDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Testimonial::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('description', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
		);
		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		return view('admin.contents.testimonial.create');
	}

	public function store(TestimonialRequest $request)
	{
		$dto = TestimonialDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.testimonials.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Testimonial $testimonial)
	{
		$testimonial->load('media');

		return view('admin.contents.testimonial.edit', compact('testimonial'));
	}

	public function update(TestimonialRequest $request, Testimonial $testimonial)
	{
		$dto = TestimonialDto::fromRequest($request);
		if ($this->service->update($testimonial, $dto)) {
			return redirect(route('admin.testimonials.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Testimonial $testimonial)
	{
		if ($testimonial->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
