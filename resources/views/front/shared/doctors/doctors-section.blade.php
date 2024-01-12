@if($doctors->isNotEmpty())
	<section class="custom-container mb-20">
		@include('front.shared.section-title', [
			'title' => $title ?? __('front/doctor.plural'),
		])
		<div class="swiper doctors-swiper !py-5 !px-2">
			<div class="swiper-wrapper">
				@foreach($doctors as $doctor)
					<div class="swiper-slide">
						@include('front.shared.doctor-card', ['doctor' => $doctor])
					</div>
				@endforeach
			</div>
		</div>
		<div class="swiper-pagination doctors-swiper-pagination"></div>
	</section>
@endif