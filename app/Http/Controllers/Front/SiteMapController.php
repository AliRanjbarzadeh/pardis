<?php

namespace App\Http\Controllers\Front;

use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\ClinicService;

class SiteMapController extends Controller
{
	public function __construct(
		protected CategoryService $categoryService,
		protected BlogService $blogService,
		protected ClinicService $clinicService
	)
	{
	}

	/*==================Index====================*/
	public function index()
	{
		$data = [
			[
				'loc' => url(''),
				'priority' => '1.0',
			],
			[
				'url' => url(''),
				'image' => [
					'loc' => url(asset('assets/front/images/logo-small.png')),
					'caption' => __('front/global.words.app.sitemap_name'),
				],
			],
			[
				'loc' => urldecode(route('about')),
			],
			[
				'loc' => urldecode(route('contact.index')),
			],
			[
				'loc' => urldecode(route('services.index')),
			],
			[
				'loc' => urldecode(route('clinics.index')),
			],
		];

		$categories = $this->categoryService->all(type: TypeEnum::Blog, relations: ['seo']);
		foreach ($categories as $category) {
			$mData = [
				'loc' => urldecode($category->getDetailLink('blog')),
				'changefreq' => 'Monthly',
				'priority' => '0.7',
			];

			$data[] = $mData;
		}

		$blogs = $this->blogService->all(relations: ['media', 'seo']);
		foreach ($blogs as $blog) {
			$mData = [
				'loc' => urldecode(route('blogs.show', $blog->seo->link)),
				'lastmod' => $blog->updated_at->setTimezone("Asia/Tehran")->toIso8601String(),
				'priority' => '0.9',
				'image' => [
					'loc' => $blog->feature_image->medium,
					'caption' => $blog->title
				],
			];

			$data[] = $mData;
		}

		$clinics = $this->clinicService->all(relations: ['media', 'seo']);
		foreach ($clinics as $clinic) {
			$mData = [
				'loc' => urldecode(route('clinics.show', $clinic->seo->link)),
				'lastmod' => $clinic->updated_at->setTimezone("Asia/Tehran")->toIso8601String(),
				'priority' => '0.9',
				'image' => [
					'loc' => $clinic->feature_image->medium,
					'caption' => $clinic->title
				],
			];

			$data[] = $mData;
		}

		return response()->view('front.contents.sitemap.index', compact('data'))
			->header('Content-Type', 'text/xml');
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
