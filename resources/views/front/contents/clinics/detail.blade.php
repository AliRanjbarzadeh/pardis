@extends('front.layouts.master')

@section('content')
	<main class="custom-container pb-10">
		<div class="grid grid-cols-5 lg:grid-cols-4 gap-4 mt-7">
			<section class="md:col-span-3 col-span-5">
				@include('front.shared.section-title', [
					'title' => $clinic->title,
					'class' => 'md:pt-12',
				])
				<div class="w-full rounded-md overflow-hidden h-[350px] lg:h-[450px] xl:h-[550px]">
					<img class="w-full h-full object-cover" src="{{ $clinic->feature_image->large }}" alt="{{ $clinic->title }}">
				</div>
				<div class="content mb-14 mt-5 leading-8">{!! $clinic->description !!}</div>
			</section>
			<aside class="md:col-span-2 lg:col-span-1 col-span-5">
				@if(!empty($clinic->work_hours))
					@include('front.shared.section-title', [
						'title' => __('front/work_hour.words.clinic'),
						'class' => 'md:pt-12',
						'fontSize' => 'text-lg',
					])
					@include('front.shared.work-hour-section', ['workHours' => $clinic->work_hours])
				@endif

				@if($clinic->contacts->isNotEmpty())
					@include('front.shared.section-title', [
						'title' => __('front/contact_info.plural'),
						'class' => 'md:pt-12',
						'fontSize' => 'text-lg',
					])
					@include('front.shared.contacts.contact-section', ['contacts' => $clinic->contacts])
				@endif
			</aside>
		</div>
		@if($clinic->doctors->isNotEmpty())
			@include('front.shared.doctors.doctors-section', ['title' => __('front/clinic.words.doctors'), 'doctors' => $clinic->doctors])
		@endif

		@if($clinic->insurances->isNotEmpty())
			@include('front.shared.insurances.insurances-section', ['title' => __('front/clinic.words.insurances'), 'insurances' => $clinic->insurances])
		@endif
	</main>
@endsection

@push('scripts')
	@vite('resources/js/pages/clinics/detail.js')
@endpush