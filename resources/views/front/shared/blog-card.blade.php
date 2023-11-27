<a href="{{ route('blogs.show', $blog->seo->link) }}" class="p-2 md:p-3 shadow-md hover:shadow-[0px_14px_20px_0px_#00000026] transition ease-in-out hover:-translate-y-1 rounded bg-white flex flex-col justify-between">
	<div>
		<img class="rounded-md h-28 md:h-40 w-full object-cover mb-3" src="{{ $blog->feature_image->medium }}" alt="{{ $blog->title }}">

		<h4 class="font-bold px-1 mb-2 line-clamp-2 leading-4 h-8 md:leading-5 md:h-10">{{ $blog->title }}</h4>
	</div>


	<div class="flex justify-between items-center w-full">
		<span class="text-black opacity-50 text-xs">{{ $blog->created_at_ago }}</span>
		<span class="text-secondary-800 bg-secondary-100 bg-opacity-30 border border-secondary-100 border-opacity-30 px-1 py-[2px] md:px-3 md:py-2 rounded text-[10px] md:text-xs">{{ $blog->categories->first()->name }}</span>
    </div>
</a>
