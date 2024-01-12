@if($blogs->isNotEmpty())
	<section class="custom-container pt-14 pb-9">
		@include('front.shared.section-title', [
			'title' => $title ?? __('front/blog.plural'),
			'url' => route('blogs.index')
		])
		<div class="swiper blog-swiper !py-5 !px-2">
			<div class="swiper-wrapper">
				@foreach($blogs as $blog)
					<div class="swiper-slide">
						@include('front.shared.blog-card', ['blog' => $blog])
					</div>
				@endforeach
			</div>
		</div>
		<div class="swiper-pagination blog-swiper-pagination"></div>
	</section>
@endif
