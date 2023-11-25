@extends('front.layouts.master')

@section('content')
	<section class="md:hidden block custom-container">
		@include('front.shared.search-section', ['action' => route('blogs.index'), 'placeholder' => __('front/blog.words.search')])
	</section>
	<div class="grid grid-cols-5 lg:grid-cols-4 gap-4 mt-7 custom-container mb-16">
		<section class="md:col-span-3 col-span-5">
			<div class="rounded-lg shadow-md bg-white w-full mb-12">
				<div class="content-container p-4">
					<div class="banner w-full h-[240px] md:h-[250px] lg:h-[400px] xl:h-[460px] rounded-lg overflow-hidden">
						<img class="w-full h-full object-cover" src="{{ $blog->feature_image->large }}" alt="{{ $blog->title }}">
					</div>
					<h1 class="text-xl font-bold md:text-lg mt-5 mb-3">{{ $blog->title }}</h1>
					<div class="flex justify-between flex-wrap items-end">
						<div>
							<span class="me-1">@lang('front/category.singular') :</span>
							<a href="{{ $blog->categories->first()->getDetailLink('blog') }}">{{ $blog->categories->first()->name }}</a>
						</div>
						<div class="flex items-center text-gray-400">
							<span class="material-symbols-outlined outline-icon me-1">schedule</span>
							<span>{{ $blog->created_at_ago }}</span>
						</div>
					</div>
					<div class="content mt-4">{!! $blog->description !!}</div>

					@if($blog->tags->isNotEmpty())
						@include('front.shared.tags-card', ['tags' => $blog->tags])
					@endif
				</div>
				@if($blog->doctors->isNotEmpty() || $blog->clinics->isNotEmpty())
					<hr class="border-gray-200 w-full mt-3">
					<div class="mt-5 grid grid-cols-1 sm:grid-cols-2 px-5 pb-8">
						@if($blog->doctors->isNotEmpty())
							@include('front.shared.doctor-related-card', ['doctor' => $blog->doctors->first()])
						@endif

						@if($blog->clinics->isNotEmpty())
							@include('front.shared.clinic-related-card', ['clinic' => $blog->clinics->first()])
						@endif
					</div>
				@endif
			</div>


			<section>
				@include('front.shared.comments-section', ['comments' => $blog->comments, 'count' => $blog->comments_count])
			</section>

			<section>
				@include('front.shared.comment-form-section', ['action' => route('comments.store', $blog->id), 'modelType' => get_class($blog)])
			</section>
		</section>
		@include('front.contents.blogs.sidebar', ['blogs' => $topItems, 'categories' => $categories])
	</div>
@endsection

@push('styles')
	@vite('resources/css/pages/blog/blog-details.scss')
@endpush