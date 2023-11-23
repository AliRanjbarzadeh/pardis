@extends('front.layouts.master')

@section('content')
	<main class="pt-14 pb-14">
		<div class="custom-container">
			<div class="flex items-center mb-5">
				<div class="rounded-xl me-4 shadow-[0px_1px_10px_0px_#0000000D] p-2 bg-white w-14 h-14">
					<img src="{{ $service->getMediumByName('iconImage')->url }}" alt="{{ $service->title }}">
				</div>
				<strong class="text-lg text-primary-950">{{ $service->title }}</strong>
			</div>
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
				<div class="h-[435px] xl:h-[500px] rounded-3xl shadow-btn1 overflow-hidden">
					<img src="{{ $service->feature_image->large }}" class="w-full h-full object-cover" alt="{{ $service->title }}">
				</div>
				<p class="leading-10 text-base">{{ $service->description }}</p>
			</div>
		</div>
	</main>
@endsection