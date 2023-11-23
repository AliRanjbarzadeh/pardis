@extends('front.layouts.master')

@section('content')
	<main class="pt-14">
		<div class="custom-container">
			@include('front.shared.section-title', [
				'title' => $page->title,
			])
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-14">
				<div class="h-[435px] xl:h-[500px] rounded-3xl shadow-btn1 overflow-hidden">
					<img src="{{ $page->feature_image->url }}" class="w-full h-full object-cover" alt="{{ $page->title }}">
				</div>
				<p class="leading-10 text-base">{{ $page->description }}</p>
			</div>
		</div>
		@include('front.shared.photo-gallery.photo-gallery', ['galleries' => $galleries, 'isGallery' => true])
	</main>
@endsection

@push('scripts')
	@vite('resources/js/pages/about/index.js')
@endpush