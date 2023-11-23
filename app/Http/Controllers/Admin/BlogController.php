<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\DataTransferObjects\BlogDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PageDto;
use App\Enums\PageTypeEnum;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Http\Requests\Admin\BlogEditRequest;
use App\Http\Requests\Admin\DatatablesFilterRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Blog;
use App\Models\Page;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\ClinicService;
use App\Services\DoctorService;
use App\Services\PageService;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
	public function __construct(
		protected BlogService     $service,
		protected CategoryService $categoryService,
		protected TagService      $tagService,
		protected DoctorService   $doctorService,
		protected ClinicService   $clinicService,
		protected PageService     $pageService,
	)
	{
		View::share('title', __('admin/blog.plural'));
	}

	/*==================Index====================*/
	public function index(BlogDataTable $dataTable)
	{
		$dataTable->setCategories($this->categoryService->all(TypeEnum::Blog)->mapWithKeys(fn($item) => [$item->id => $item->name]));
		return $dataTable->render('admin.contents.datatable');
	}

	public function datatable(DatatablesFilterRequest $request)
	{
		$dto = new DatatablesFilterDto(
			term: $request->post('title', ''),
			fromDate: $request->post('from_created_at'),
			toDate: $request->post('to_created_at'),
			categoryId: $request->post('category_id')
		);
		return $this->service->datatable($dto);
	}

	/*==================Create====================*/
	public function create()
	{
		$categories = $this->categoryService->all(TypeEnum::Blog);
		$tags = $this->tagService->all();
		$doctors = $this->doctorService->all();
		$clinics = $this->clinicService->all();

		return view('admin.contents.blog.create', compact('categories', 'tags', 'doctors', 'clinics'));
	}

	public function store(BlogCreateRequest $request)
	{
		$dto = BlogDto::fromRequest($request)
			->setTags($request->input('tags'));
		if (is_null($this->service->store($dto))) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}

		return redirect(route('admin.blogs.create'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Edit====================*/
	public function edit(Blog $blog)
	{
		$blog->load(['media', 'categories', 'tags', 'seo', 'doctors', 'clinics']);
		$categories = $this->categoryService->all(TypeEnum::Blog);
		$tags = $this->tagService->all();
		$doctors = $this->doctorService->all();
		$clinics = $this->clinicService->all();

		return view('admin.contents.blog.edit', compact('blog', 'categories', 'tags', 'doctors', 'clinics'));
	}

	public function update(BlogEditRequest $request, Blog $blog)
	{
		$dto = BlogDto::fromRequest($request)
			->setTags($request->input('tags'));
		if ($this->service->update($blog, $dto)) {
			return redirect(route('admin.blogs.index'))->with('success', __('admin/global.successes.update'));
		}

		return back()->withInput()->withErrors(['failed' => __('admin/global.errors.update')]);
	}

	public function destroy(Blog $blog)
	{
		if ($blog->delete()) {
			return response()->json(['message' => __('admin/global.successes.delete')]);
		}
		return response()->json(['message' => __('admin/global.errors.delete')], 400);
	}

	/*==================Settings====================*/
	public function settings()
	{
		$page = $this->pageService->find(PageTypeEnum::Blogs, ['metas']);
		return view('admin.contents.blog.settings', compact('page'));
	}

	public function settingsStore(PageRequest $request)
	{
		$dto = PageDto::fromRequest($request)
			->setType(PageTypeEnum::Blogs)
			->setMetas($request->input('metas'));

		if (!$this->pageService->updateOrCreate($dto)) {
			return back()->withInput()->withErrors(['failed' => __('admin/global.errors.store')]);
		}
		return redirect(route('admin.blogs.settings.index'))->with('success', __('admin/global.successes.store'));
	}

	/*==================Search====================*/
	public function search(Request $request)
	{
		return $this->service->search($request->post('term'), $request->post('ids', []));
	}
}
