@extends('front.layouts.master')

@section('content')
	<main class="custom-container pt-14 pb-10">
		<section class="md:hidden block">
			@include('front.shared.search-section', ['placeholder' => __('front/blog.words.search')])
		</section>
		@include('front.shared.section-title', [
			'title' => $page->title,
			'description' => $page->description,
			'class' => 'hidden md:block',
		])
		<div class="grid grid-cols-5 lg:grid-cols-4 gap-4 mt-7">
			<section class="md:col-span-3 col-span-5">
				<div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
					@foreach($blogs as $blog)
						@include('front.shared.blog-card', ['blog' => $blog])
					@endforeach
				</div>
				{{ $blogs->links(null, ['class' => 'mt-9 mb-8']) }}
			</section>
			@include('front.contents.blogs.sidebar', ['blogs' => $topItems, 'categories' => $categories])
		</div>

		<div class="hidden md:block">
			@include('front.shared.limited-paragraph', ['description' => $page->full_description])
		</div>
	</main>
@endsection