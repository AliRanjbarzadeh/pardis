@extends('front.layouts.master')

@section('content')
	<main class="pt-14 pb-14">
		<div class="custom-container">
			@include('front.shared.section-title', [
				'title' => $page->title,
				'description' => $page->description,
				'class' => 'mb-14',
			])
			<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-x-0 gap-y-8 md:gap-8 w-full mb-16">
				@foreach($services as $service)
					@include('front.shared.service-card', ['service' => $service])
				@endforeach
			</div>
			@include('front.shared.limited-paragraph', ['description' => $page->full_description])
		</div>
	</main>
@endsection