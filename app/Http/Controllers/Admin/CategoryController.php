<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\DataTransferObjects\CategoryDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryEditRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
	public function __construct(
		protected CategoryService $service,
	)
	{
		View::share('title', __('admin/category.plural'));
	}

	/*==================Index====================*/
	public function index(Request $request, CategoryDataTable $dataTable)
	{
		$dataTable->setType($request->segment(3));
		$dataTable->addPriorityButton(route('admin.priority'), Category::class);
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('name', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
			type: $request->segment(3),
			hasChildren: $this->hasChildren($request->segment(3))
		);

		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		return view('admin.contents.category.create');
	}

	public function store(CategoryRequest $request)
	{
		$dto = CategoryDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.categories.' . $request->segment(3) . '.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Category $category)
	{
		return view('admin.contents.category.edit', compact('category'));
	}

	public function update(CategoryEditRequest $request, Category $category)
	{
		$dto = CategoryDto::fromRequest($request);
		if ($this->service->update($category, $dto)) {
			return redirect(route('admin.categories.' . $request->segment(3) . '.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Category $category)
	{
		if ($category->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Others====================*/
	private function hasChildren(string $type): bool
	{
		return in_array(TypeEnum::tryFrom($type), [TypeEnum::Insurance]);
	}
}
