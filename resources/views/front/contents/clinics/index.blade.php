@extends('front.layouts.master')

@section('content')
	<main class="pt-14 pb-14">
		<div class="custom-container">
			@include('front.shared.section-title', [
				'title' => $page->title,
				'description' => $page->description,
				'class' => 'mb-14',
			])
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 w-full gap-5">
				@foreach($clinics as $clinic)
					@include('front.shared.clinic-card', ['clinic' => $clinic])
				@endforeach
			</div>
			{{ $clinics->links(null, ['class' => 'mt-9 mb-14 mx-auto w-fit']) }}
			@include('front.shared.limited-paragraph', ['description' => $page->full_description])
		</div>
	</main>
@endsection