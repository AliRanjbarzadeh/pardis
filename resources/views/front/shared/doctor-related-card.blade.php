<div class="mb-3 md:mb-0">
	<h4 class="text-lg md:text-xl font-bold text-gray-350 mb-4">@lang('front/blog.words.related.doctor')</h4>
	<a href="{{ $doctor->show_link }}" class="flex items-center hover:text-secondary-950">
		<div class="shadow-md rounded-[100%] w-20 h-20 overflow-hidden me-3 flex-[5rem_0_0]">
			<img class="w-full h-full object-cover" src="{{ $doctor->feature_image->thumbnail }}" alt="{{ $doctor->full_name }}">
		</div>
		<div>
			<strong class="text-base md:text-lg mb-1 line-clamp-2">{{ $doctor->full_name }}</strong>
			<p class="text-gray-300 line-clamp-2">{{ $doctor->specialities->first()->name }}</p>
		</div>
	</a>
</div>