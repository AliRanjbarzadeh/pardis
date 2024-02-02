<section class="bg-white pt-6 md:pt-14 pb-16">
	<div class="custom-container">
		@include('front.shared.section-title', [
			'title' => __('front/testimonial.plural'),
			'class' => 'md:pb-12',
		])
		<div class="grid grid-cols-1 md:grid-cols-2 gap-11">
			<div>
				<div class="swiper videos-swiper h-full w-full">
					<div class="swiper-wrapper">
						@foreach($testimonials as $testimonial)
							<div class="swiper-slide">
								<div id="{{ 'testimonial-' . $testimonial->id }}">
									<script type="text/JavaScript" src="{{ $testimonial->url }}?data[rnddiv]={{ 'testimonial-' . $testimonial->id }}&data[responsive]=yes"></script>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				<div class="swiper-pagination videos-swiper-pagination mt-4"></div>
			</div>
			<p id="testimonial-content" class="leading-8">{{ $testimonials->first()->description }}</p>
		</div>
	</div>
</section>

@push('scripts')
	<script type="text/javascript">
		const testimonials = @json($testimonials);
	</script>
@endpush
