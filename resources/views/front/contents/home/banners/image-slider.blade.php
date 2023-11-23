<!-- Slider main container -->
<section class="custom-container mt-7 mb-7 lg:mb-12">
	<div class="relative h-[200px] md:h-[410px] lg:h-[550px] rounded-md shadow-[0px_0px_10px_0px_#00000033] overflow-hidden">
		<div class="swiper images-swiper h-full w-full">
			<div class="swiper-wrapper">
				@foreach($sliders as $slider)
					<div class="swiper-slide">
						<img class="w-full h-full object-cover" src="{{ $slider->feature_image->large }}" alt="{{ $slider->title }}">
					</div>
				@endforeach
			</div>
		</div>
		<div id="slider-content" class="group absolute flex items-end inset-0 w-full h-full bg-gradient-to-t from-black/50 to-transparent z-10">
			<div class="p-3 md:p-6 text-white flex items-center justify-between w-full transition-all opacity-100 translate-y-0 group-[.fade-out]:opacity-0 group-[.fade-out]:translate-y-2">
				<div class="w-[calc(100%_-_100px)] md:w-auto">
					<p id="slider-title" class="text-sm md:text-xl font-bold mb-2"></p>
					<p id="slider-description" class="text-xs md:text-base text-[#F4E6E6]"></p>
				</div>
				<a id="slider-url" href="#" class="btn btn-secondary text-xs !rounded-full md:!rounded-lg md:text-base px-3 md:px-10 py-2 !bg-opacity-90 shadow-md">@lang('front/global.words.view.more')</a>
			</div>
		</div>
	</div>
	<div class="swiper-pagination images-swiper-pagination mt-4"></div>
	<span id="slides" class="hidden">@json($sliders->map(fn($slider) => $slider->swiper_slide))</span>
</section>