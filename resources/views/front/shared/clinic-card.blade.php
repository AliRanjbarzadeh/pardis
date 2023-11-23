<div class="p-2 lg:p-3 shadow-md rounded bg-white">
    <img class="rounded-md h-28 lg:h-32 xl:h-40 w-full object-cover mb-3" src="{{ $clinic->feature_image->medium }}" alt="{{ $clinic->title }}">
    <h4 class="md:mb-3 md:font-bold md:text-center px-1">{{ $clinic->title }}</h4>
	<a href="{{ route('clinics.show', $clinic->seo->link) }}" class="btn btn-primary btn-outline w-full py-1 !hidden md:!inline-flex">
		@lang('front/global.words.more_info')
	</a>
</div>
