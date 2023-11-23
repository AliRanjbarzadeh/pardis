<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GalleryDataTable;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\GalleryDto;
use App\DataTransferObjects\SeoDto;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\GalleryCreateRequest;
use App\Http\Requests\Admin\GalleryEditRequest;
use App\Models\Gallery;
use App\Services\CategoryService;
use App\Services\GalleryService;

class GalleryController extends Controller
{
	public function __construct(
		protected GalleryService  $service,
		protected CategoryService $categoryService,
	)
	{
	}

	/*==================Index====================*/
	public function index(GalleryDataTable $dataTable)
	{
		$dataTable->addPriorityButton(route('admin.priority'), Gallery::class);
		$dataTable->setCategories($this->categoryService->all(TypeEnum::Gallery)->mapWithKeys(fn($item) => [$item->id => $item->name]));
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('title', ''),
			fromDate: $request->post('from_created_at', ''),
			toDate: $request->post('to_created_at', ''),
			categoryId: $request->post('category_id'),
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$categories = $this->categoryService->all(TypeEnum::Gallery);

		return view('admin.contents.gallery.create', compact('categories'));
	}

	public function store(GalleryCreateRequest $request)
	{
		$dto = new GalleryDto(
			title: $request->input('title'),
			categoryId: $request->input('category_id'),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage')
		);

		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.store')]);
		}

		return redirect(route('admin.galleries.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Gallery $gallery)
	{
		$gallery->load(['seo', 'media']);

		$categories = $this->categoryService->all(TypeEnum::Gallery);

		return view('admin.contents.gallery.edit', compact('categories', 'gallery'));
	}

	public function update(GalleryEditRequest $request, Gallery $gallery)
	{
		$dto = new GalleryDto(
			title: $request->input('title'),
			categoryId: $request->input('category_id'),
			seo: SeoDto::fromRequest($request),
			featureImage: $request->file('featureImage')
		);

		$gallery->load(['seo', 'media']);
		if (is_null($this->service->update($gallery, $dto))) {
			return back()->withInput()->withErrors(['failed', __('admin/global.errors.update')]);
		}

		return redirect(route('admin.galleries.index'))->with('success', __('admin/global.successes.update'));
	}

	public function destroy(Gallery $gallery)
	{
		if ($gallery->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
