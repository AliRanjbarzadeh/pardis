<section class="bg-white">
	<div class="custom-container">
		@include('front.shared.section-title', [
			'title' => $title ?? __('front/gallery.plural'),
			'class' => 'pt-14',
		])
		<div class="swiper photo-gallery-swiper !py-5 !px-2">
			<div class="swiper-wrapper">
				@if($isGallery ?? false)
					@foreach($galleries as $gallery)
						<div class="swiper-slide">
							@include('front.shared.photo-gallery.gallery-item', ['gallery' => $gallery])
						</div>
					@endforeach
				@else
					@foreach($media as $medium)
						<div class="swiper-slide">
							@include('front.shared.photo-gallery.medium-item', ['medium' => $medium])
						</div>
					@endforeach
				@endif
			</div>
		</div>
		<div class="swiper-pagination photo-gallery-swiper-pagination"></div>
	</div>
</section>
