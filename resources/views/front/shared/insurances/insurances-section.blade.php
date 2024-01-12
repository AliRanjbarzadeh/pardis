@if($insurances->isNotEmpty())
	<section class="pt-14 pb-9">
		@include('front.shared.section-title', [
			'title' => $title ?? __('front/insurance.plural'),
		])
		<div class="swiper insurances-swiper !py-5 !px-2">
			<div class="swiper-wrapper">
				@foreach($insurances as $insurance)
					<div class="swiper-slide">
						@include('front.shared.insurance-card', ['insurance' => $insurance])
					</div>
				@endforeach
			</div>
		</div>
		<div class="swiper-pagination insurances-swiper-pagination"></div>
	</section>
@endif
