<div class="shadow-md rounded-xl overflow-hidden bg-white">

	<a href="{{ route('doctors.show', [$doctor, $doctor->seo->link]) }}">
		<div class="h-36 md:h-52 w-full mb-2 md:mb-3 relative">
			<img class="object-cover object-center h-full w-full" src="{{ asset('assets/front/images/test/doctors/bg.png') }}" alt="{{ $doctor->full_name }}">
			<img class="absolute bottom-0 inset-x-0 mx-auto object-contain object-center h-[90%]" src="{{ $doctor->feature_image->medium }}" alt="{{ $doctor->full_name }}">
		</div>
	</a>

	<div class="px-2">
		<a href="{{ route('doctors.show', [$doctor, $doctor->seo->link]) }}">
			<h4 class="my-2 font-bold md:text-center text-sm">{{ $doctor->full_name }}</h4>
		</a>

		@if($doctor->specialities->isNotEmpty())
			<p class="mb-2 md:mb-3 text-gray-300 md:text-center text-xs line-clamp-2 leading-4 h-8 md:leading-5 md:h-10">{{ $doctor->specialities->first()->name }}</p>
		@endif
	</div>
	<a href="{{ route('doctors.show', [$doctor, $doctor->seo->link]) }}" class="btn btn-primary w-full py-2.5 rounded-none text-xs">
		@lang('front/global.words.more_info')
	</a>
</div>
