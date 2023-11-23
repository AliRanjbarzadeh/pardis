<div class="shadow-md rounded-xl overflow-hidden bg-white">
	<img class="h-36 md:h-52 w-full object-cover mb-2 md:mb-3 object-center" src="{{ $doctor->feature_image->medium }}" alt="{{ $doctor->full_name }}">
	<div class="px-2">
		<h4 class="mb-2 font-bold md:text-center text-xs md:text-sm">{{ $doctor->full_name }}</h4>

		@if($doctor->specialities->isNotEmpty())
			<p class="mb-1 md:mb-3 text-gray-300 md:text-center text-[10px] md:text-xs">{{ $doctor->specialities->first()->name }}</p>
		@endif
	</div>
	<a href="{{ route('doctors.show', [$doctor, $doctor->seo->link]) }}" class="btn btn-primary w-full py-1 md:py-2 rounded-none text-[10px] md:text-xs">
		@lang('front/global.words.more_info')
	</a>
</div>
