<aside class="md:col-span-2 lg:col-span-1 col-span-5">
	<section class="hidden md:block">
		@include('front.shared.search-section', ['action' => route('blogs.index'), 'placeholder' => __('front/blog.words.search')])
	</section>
	<section>
		@include('front.shared.section-title', [
			'title' => __('front/category.plural'),
			'class' => 'md:pt-12',
			'fontSize' => 'text-lg',
		])
		<div class="shadow-md bg-white rounded-md mb-5 sm:mb-auto">
			<ul>
				@foreach($categories as $category)
					@include('front.shared.blog-category-sidebar', ['category' => $category])
				@endforeach
			</ul>
		</div>
	</section>
	@if($blogs->isNotEmpty())
		<section class="hidden md:block mb-10">
			@include('front.shared.section-title', [
				'title' => __('front/blog.words.top_items'),
				'class' => 'pt-12',
				'fontSize' => 'text-lg',
			])
			@foreach($blogs as $blog)
				@include('front.shared.blog-top-item', ['blog' => $blog])
			@endforeach
		</section>
	@endif
</aside>