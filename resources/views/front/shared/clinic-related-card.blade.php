<div>
	<h4 class="text-lg md:text-xl font-bold text-gray-350 mb-4">@lang('front/blog.words.related.clinic')</h4>
	<a href="{{ $clinic->show_link }}" class="flex items-center hover:text-secondary-950">
		<div class="shadow-md rounded-[100%] w-20 h-20 overflow-hidden me-3 flex-[5rem_0_0]">
			<img class="w-full h-full object-cover" src="{{ $clinic->feature_image->thumbnail }}" alt="{{ $clinic->title }}">
		</div>
		<strong class="text-base md:text-lg line-clamp-2">{{ $clinic->title }}</strong>
	</a>
</div>