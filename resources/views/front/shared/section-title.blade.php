<div class="section-title {{ $class ?? '' }}">
	<div class="flex justify-between">
		<h3 class="before:w-9 before:h-9 before:bg-primary-950 before:bg-opacity-10 before:absolute before:rounded-full before:-top-4 rtl:before:-right-4 ltr:before:-left-4 mb-4 ms-4 relative font-bold @if(isset($url)) flex-[0_0_60%] w-[60%] @endif @if(isset($fontSize)) {{ $fontSize }} @else text-lg md:text-xl @endif">{{ $title }}</h3>
		@if(isset($url))
			<a href="{{ $url }}" class="btn btn-outline btn-primary !rounded-full px-3 text-xs md:px-5 py-1">
				{{ $buttonText ?? __('front/global.words.view.all') }}
			</a>
		@endif
	</div>

	@if(isset($description))
		<p class="text-gray-500 leading-8">{{ $description }}</p>
	@endif
</div>
