@if($clinics->isNotEmpty())
	<section class="custom-container mb-10">
		@include('front.shared.section-title', [
			'title' => $title ?? __('front/clinic.plural'),
			'description' => $description ?? '',
			'url' => route('clinics.index')
		])
		<div class="swiper clinics-swiper !py-5 !px-2">
			<div class="swiper-wrapper">
				@foreach($clinics as $clinic)
					<div class="swiper-slide">
						@include('front.shared.clinic-card', ['clinic' => $clinic])
					</div>
				@endforeach
			</div>
		</div>
		<div class="swiper-pagination clinics-swiper-pagination"></div>
	</section>
@endif