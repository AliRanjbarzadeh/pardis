<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\BlogService;

class AmpController extends Controller
{
	public function __construct(
		protected BlogService $blogService,
	)
	{
	}

	/*==================Index====================*/
	public function index(string $seoLink)
	{
		$blog = $this->blogService->findByLink($seoLink);
		if (is_null($blog)) {
			abort(404);
		}

		return view('front.contents.amp.index', compact('blog'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
	public function rate(Blog $blog)
	{
	}
	public function comment(Blog $blog)
	{
	}
}
