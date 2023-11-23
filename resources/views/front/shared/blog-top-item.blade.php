<a href="{{ route('blogs.show', $blog->seo->link) }}" class="mb-3 last:mb-0 shadow-md rounded-md p-2 flex bg-white">
	<div class="rounded-md overflow-hidden flex-grow-0 flex-shrink-0 basis-20 h-16 me-2">
		<img src="{{ $blog->feature_image->thumbnail }}" class="w-full h-full object-cover" alt="{{ $blog->title }}">
	</div>
	<div>
		<h5 class="font-bold text-sm pb-1 line-clamp-2">{{ $blog->title }}</h5>
		<span class="text-gray-300">{{ $blog->created_at_ago }}</span>
	</div>
</a>