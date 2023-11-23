<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryChildDataTable;
use App\DataTransferObjects\CategoryDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryEditRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Models\Category;
use App\Services\CategoryChildService;
use Illuminate\Http\Request;

class CategoryChildController extends Controller
{
	public function __construct(
		protected CategoryChildService $service,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request, CategoryChildDataTable $dataTable, Category $parent)
	{
		$dataTable->setType($request->segment(3));
		$dataTable->setParent($parent->id);
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
			parent: $request->route('parent')
		);
		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create(Category $parent)
	{
		return view('admin.contents.category.child.create', compact('parent'));
	}

	public function store(CategoryRequest $request, Category $parent)
	{
		$dto = CategoryDto::fromRequest($request);
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.categories.' . $request->segment(3) . '.children.create', $request->route('parent')))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Category $parent, Category $category)
	{
		return view('admin.contents.category.child.edit', compact('parent', 'category'));
	}

	public function update(CategoryEditRequest $request, Category $parent, Category $category)
	{
		$dto = CategoryDto::fromRequest($request);
		if ($this->service->update($category, $dto)) {
			return redirect(route('admin.categories.' . $request->segment(3) . '.children.index', $parent))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Category $parent, Category $category)
	{
		if ($category->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}
}
