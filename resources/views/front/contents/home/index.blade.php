@extends('front.layouts.master')

@section('content')
	@include('front.shared.modal.modal', ['popup' => $popup])
	<main>
		@include('front.contents.home.banners.image-slider', ['sliders' => $sliders])

		@include('front.contents.home.clinics.clinics-section', ['title' => $page->getMetaValue('clinic')['title'], 'description' => $page->getMetaValue('clinic')['description'], 'clinics' => $clinics])

		<div class="bg-white pt-10 pb-4 mb-20">
			@include('front.shared.doctors.doctors-section', ['title' => $page->getMetaValue('doctor')['title'], 'doctors' => $doctors])
		</div>

		@include('front.contents.home.services.services-section', ['title' => $page->getMetaValue('service')['title'], 'description' => $page->getMetaValue('service')['description'], 'services' => $services])

		@if($testimonials->isNotEmpty())
			@include('front.contents.home.testimonials.testimonial', ['testimonials' => $testimonials])
		@endif

		@if($page->faqs->isNotEmpty())
			@include('front.contents.home.faqs.faq-section', ['faqs' => $page->faqs])
		@endif

		<div class="bg-white">
			<div class="custom-container">
				@include('front.shared.insurances.insurances-section', ['title' => $page->getMetaValue('insurance')['title'], 'insurances' => $insurances])
			</div>
		</div>

		@include('front.contents.home.blogs.blog-latest-section', ['blogs' => $blogs, 'title' => $page->getMetaValue('blog')['title']])

		@include('front.contents.home.contacts.contact-section', ['communications' => $communications])
	</main>
@endsection

@push('scripts')
	@vite('resources/js/pages/home/home.js')
@endpush