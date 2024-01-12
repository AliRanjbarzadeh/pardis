@if($services->isNotEmpty())
	<section class="custom-container flex flex-col items-center mb-14">
		<div class="home-about-title flex flex-col items-center order-1">
			<h2 class="font-bold text-2xl mb-5">{{ $title ?? __('front/service.plural') }}</h2>
			<hr class="border-primary-950 w-48 opacity-20 mb-4">
			<span class="text-gray-400 mb-8">@lang('front/service.words.ours')</span>
		</div>
		<div class="home-about-description w-full flex flex-col items-center order-3 md:order-2">
			<p class="text-center text-black opacity-70 leading-8 px-0 md:px-6 mb-5">
				{{ $description ?? '' }}
			</p>
			<a href="{{ route('services.index') }}" class="btn btn-secondary px-10 py-2 shadow-btn2 !rounded-full mb-0 md:mb-16">
				@lang('front/global.words.read_more')
			</a>
		</div>
		<div class="grid grid-cols-4 gap-6 md:gap-8 w-full order-2 md:order-3 mb-3 md:mb-0">
			@foreach($services as $service)
				@include('front.shared.service-card', ['service' => $service, 'class' => $loop->iteration > 4 ? 'hidden md:flex' : ''])
			@endforeach
		</div>
	</section>
@endif