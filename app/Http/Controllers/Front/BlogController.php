<?php

namespace App\Http\Controllers\Front;

use App\Enums\PageTypeEnum;
use App\Enums\StatusEnum;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BlogController extends Controller
{
	public function __construct(
		protected BlogService     $service,
		protected PageService     $pageService,
		protected CategoryService $categoryService,
	)
	{
	}

	/*==================Index====================*/
	public function index(Request $request)
	{
		$page = $this->pageService->find(PageTypeEnum::Blogs, ['metas', 'seo']);

		//set seo items
		$this->setSeo($page->seo);
		$this->setPageTitle($page->seo->title);

		$blogs = $this->service->paginated(
			perPage: $page->getMetaValue('items_per_page'),
			term: $request->input('search')
		);
		if (!is_null($page->getMetaValue('top_items'))) {
			$topItems = $this->service->findByIds(Arr::pluck($page->getMetaValue('top_items'), 'id'), ['media', 'seo']);
		} else {
			$topItems = collect();
		}
		$categories = $this->categoryService->sidebarBlog();

		return view('front.contents.blogs.index', compact('page', 'blogs', 'topItems', 'categories'));
	}

	public function show(string $seoLink)
	{
		$blog = $this->service->findByLink($seoLink);
		if (is_null($blog)) {
			abort(404);
		}

		//set for breadcrumb
		$this->setModel($blog);

		//set seo items
		$this->setSeo($blog->seo);
		$this->setPageTitle($blog->seo->title);
		$this->setAmpUrl($blog->amp_url);

		$page = $this->pageService->find(PageTypeEnum::Blogs, ['metas']);

		$topItems = $this->service->findByIds(Arr::pluck($page->getMetaValue('top_items') ?? [], 'id'), ['media', 'seo']);
		$categories = $this->categoryService->sidebarBlog();

		$comments = $blog->comments()->whereStatus(StatusEnum::Approved)->latest()->paginate();

		return view('front.contents.blogs.detail', compact('topItems', 'categories', 'blog', 'comments'));
	}

	public function category(Request $request, string $seoLink)
	{
		$category = $this->categoryService->findByLink(TypeEnum::Blog, $seoLink);

		if (is_null($category)) {
			abort(404);
		}

		//set seo items
		$this->setSeo($category->seo);
		$this->setPageTitle($category->seo->title);

		$page = $this->pageService->find(PageTypeEnum::Blogs, ['metas']);

		$blogs = $this->service->paginated(
			perPage: $page->getMetaValue('items_per_page'),
			categoryId: $category->id,
			term: $request->input('search')
		);
		$topItems = $this->service->findByIds(Arr::pluck($page->getMetaValue('top_items') ?? [], 'id'), ['media', 'seo']);
		$categories = $this->categoryService->sidebarBlog();


		return view('front.contents.blogs.index', compact('page', 'blogs', 'topItems', 'categories'));
	}

	public function cancer(Request $request)
	{
		$seoLink = $request->segment(1);

		return $this->show($seoLink);
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
