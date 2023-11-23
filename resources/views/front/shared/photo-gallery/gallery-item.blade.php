<a data-fancybox="gallery" data-src="{{ $gallery->feature_image->url }}" data-caption="{{ $gallery->title ?? '' }}" class="cursor-pointer">
	<img src="{{ $gallery->feature_image->medium }}" alt="{{ $gallery->title ?? '' }}" class="w-full h-32 md:h-40 xl:h-[200px] rounded-lg shadow-md overflow-hidden object-cover object-center">
	<span class="mt-4 font-bold block text-base">{{ $gallery->title ?? '' }}</span>
</a>
